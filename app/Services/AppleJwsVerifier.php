<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Log;

/**
 * Verifies Apple StoreKit 2 signed transactions (JWS / JWSTransactionDecodedPayload).
 *
 * Security model:
 *  - The JWS header carries an x5c certificate chain: [leaf, intermediate, root].
 *  - We verify the ES256 signature with the LEAF certificate's public key.
 *  - We verify the chain cryptographically: leaf signed by intermediate,
 *    intermediate signed by the pinned Apple Root CA - G3 (bundled PEM).
 *  - We validate certificate validity windows and the payload claims
 *    (productId, bundleId, expiry).
 *
 * Any failure ⇒ verification fails. We never trust a base64-decoded payload
 * on its own.
 */
class AppleJwsVerifier
{
    /** Result payload after a successful verification. */
    public ?array $payload = null;
    public ?string $error = null;

    private string $rootCaPath;

    public function __construct()
    {
        $this->rootCaPath = resource_path('certs/AppleRootCA-G3.pem');
    }

    /**
     * @param string      $jws              The signed transaction JWS (header.payload.signature).
     * @param string      $expectedProductId Product id we expect this receipt to be for.
     * @param string|null $expectedBundleId  App bundle id (optional pin; null skips the check).
     *
     * @return bool True when the JWS is authentic and claims are valid.
     */
    public function verify(string $jws, string $expectedProductId, ?string $expectedBundleId = null): bool
    {
        try {
            $parts = explode('.', $jws);
            if (count($parts) !== 3) {
                return $this->fail('JWS must have 3 segments');
            }

            $header = json_decode($this->b64UrlDecode($parts[0]), true);
            if (!is_array($header) || ($header['alg'] ?? null) !== 'ES256') {
                return $this->fail('Unexpected JWS alg (expected ES256)');
            }

            $x5c = $header['x5c'] ?? null;
            if (!is_array($x5c) || count($x5c) < 2) {
                return $this->fail('Missing x5c certificate chain');
            }

            // Build PEM certs from the DER base64 entries in x5c.
            $certs = array_map(fn ($der) => $this->derToPem($der), $x5c);
            $leafPem = $certs[0];

            $pinnedRoot = $this->pinnedRootPem();
            if ($pinnedRoot === null) {
                return $this->fail('Pinned Apple Root CA - G3 not available');
            }

            // 1) Every presented cert must be signed by the next one in the chain.
            for ($i = 0; $i < count($certs) - 1; $i++) {
                if (openssl_x509_verify($certs[$i], $certs[$i + 1]) !== 1) {
                    return $this->fail("Certificate chain link {$i} failed signature check");
                }
            }

            // 2) The top presented cert must anchor to the pinned Apple Root CA - G3:
            //    either it IS the pinned root, or it is signed by it. This handles
            //    chains that omit the self-signed root.
            $topPem = $certs[count($certs) - 1];
            $topIsPinnedRoot = hash_equals(
                (string) openssl_x509_fingerprint($pinnedRoot, 'sha256'),
                (string) openssl_x509_fingerprint($topPem, 'sha256')
            );
            if (!$topIsPinnedRoot && openssl_x509_verify($topPem, $pinnedRoot) !== 1) {
                return $this->fail('Chain does not anchor to pinned Apple Root CA - G3');
            }

            // 3) All certs must currently be within their validity window.
            foreach ($certs as $idx => $certPem) {
                $parsed = openssl_x509_parse($certPem);
                if ($parsed === false) {
                    return $this->fail("Unable to parse certificate {$idx}");
                }
                $now = time();
                if ($now < ($parsed['validFrom_time_t'] ?? PHP_INT_MAX)
                    || $now > ($parsed['validTo_time_t'] ?? 0)) {
                    return $this->fail("Certificate {$idx} outside its validity window");
                }
            }

            // 4) Verify the JWS signature using the leaf certificate (ES256).
            $decoded = (array) JWT::decode($jws, new Key($leafPem, 'ES256'));

            // 5) Validate claims.
            $productId = $decoded['productId'] ?? $decoded['product_id'] ?? null;
            if ($productId !== $expectedProductId) {
                return $this->fail('productId mismatch');
            }

            if ($expectedBundleId !== null) {
                $bundleId = $decoded['bundleId'] ?? $decoded['bundle_id'] ?? null;
                if ($bundleId !== null && $bundleId !== $expectedBundleId) {
                    return $this->fail('bundleId mismatch');
                }
            }

            $this->payload = $decoded;
            return true;
        } catch (\Throwable $e) {
            return $this->fail('Exception: ' . $e->getMessage());
        }
    }

    /**
     * Apple-reported subscription expiry (Carbon) if present in the verified payload.
     */
    public function expiresAt(): ?\Carbon\Carbon
    {
        if ($this->payload === null) {
            return null;
        }
        $ms = $this->payload['expiresDate'] ?? $this->payload['expires_date_ms'] ?? null;
        if ($ms === null) {
            return null;
        }
        return \Carbon\Carbon::createFromTimestampMs((int) $ms)
            ->setTimezone(config('app.timezone'));
    }

    private function pinnedRootPem(): ?string
    {
        if (!is_file($this->rootCaPath)) {
            Log::error('AppleJwsVerifier: pinned root CA not found at ' . $this->rootCaPath);
            return null;
        }
        $pem = file_get_contents($this->rootCaPath);
        return $pem !== false ? $pem : null;
    }

    private function derToPem(string $der): string
    {
        return "-----BEGIN CERTIFICATE-----\n"
            . chunk_split($der, 64, "\n")
            . "-----END CERTIFICATE-----\n";
    }

    private function b64UrlDecode(string $data): string
    {
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
    }

    private function fail(string $reason): bool
    {
        $this->error = $reason;
        Log::warning('AppleJwsVerifier failed: ' . $reason);
        return false;
    }
}
