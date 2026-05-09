<?php

namespace App\Services\Agora;

/**
 * Official Agora Util helpers for AccessToken2 (v007)
 */
class Util
{
    public static function packUint16($x)
    {
        return pack("v", $x);
    }

    public static function packUint32($x)
    {
        return pack("V", $x);
    }

    public static function packInt16($x)
    {
        return pack("s", $x);
    }

    public static function packString($str)
    {
        return self::packUint16(strlen($str)) . $str;
    }

    public static function packMapUint32($arr)
    {
        ksort($arr);
        $kv = "";
        foreach ($arr as $key => $val) {
            $kv .= self::packUint16($key) . self::packUint32($val);
        }
        return self::packUint16(count($arr)) . $kv;
    }
}

class Service
{
    public $type;
    public $privileges;

    public function __construct($serviceType)
    {
        $this->type = $serviceType;
    }

    public function addPrivilege($privilege, $expire)
    {
        $this->privileges[$privilege] = $expire;
    }

    public function getServiceType()
    {
        return $this->type;
    }

    public function pack()
    {
        return Util::packUint16($this->type) . Util::packMapUint32($this->privileges);
    }
}

class ServiceRtc extends Service
{
    const SERVICE_TYPE = 1;
    const PRIVILEGE_JOIN_CHANNEL = 1;
    const PRIVILEGE_PUBLISH_AUDIO_STREAM = 2;
    const PRIVILEGE_PUBLISH_VIDEO_STREAM = 3;
    const PRIVILEGE_PUBLISH_DATA_STREAM = 4;
    public $channelName;
    public $uid;

    public function __construct($channelName = "", $uid = "")
    {
        parent::__construct(self::SERVICE_TYPE);
        $this->channelName = $channelName;
        $this->uid = strval($uid);
    }

    public function pack()
    {
        return parent::pack() . Util::packString($this->channelName) . Util::packString($this->uid);
    }
}

class AccessToken2
{
    const VERSION = "007";
    public $appCert;
    public $appId;
    public $expire;
    public $issueTs;
    public $salt;
    public $services = [];

    public function __construct($appId = "", $appCert = "", $expire = 900)
    {
        $this->appId = $appId;
        $this->appCert = $appCert;
        $this->expire = $expire;
        $this->issueTs = time();
        $this->salt = rand(1, 99999999);
    }

    public function addService($service)
    {
        $this->services[$service->getServiceType()] = $service;
    }

    public function build()
    {
        if (!self::isUUid($this->appId) || !self::isUUid($this->appCert)) {
            return "";
        }

        $signing = $this->getSign();

        // Data includes appId, issueTs, expire, salt, and service count
        $data = Util::packString($this->appId) 
              . Util::packUint32($this->issueTs) 
              . Util::packUint32($this->expire)
              . Util::packUint32($this->salt) 
              . Util::packUint16(count($this->services));

        ksort($this->services);
        foreach ($this->services as $key => $service) {
            $data .= $service->pack();
        }

        $signature = hash_hmac("sha256", $data, $signing, true);

        return self::VERSION . base64_encode(zlib_encode(Util::packString($signature) . $data, ZLIB_ENCODING_DEFLATE));
    }

    public function getSign()
    {
        // PHP hash_hmac(algo, data, key, raw)
        // Agora Python: hmac.new(key=issueTs, msg=appCert, ...)
        $hh = hash_hmac("sha256", $this->appCert, Util::packUint32($this->issueTs), true);
        
        // Agora Python: hmac.new(key=salt, msg=hmac_1, ...)
        return hash_hmac("sha256", $hh, Util::packUint32($this->salt), true);
    }

    public static function isUUid($str)
    {
        if (strlen($str) != 32) {
            return false;
        }
        return ctype_xdigit($str);
    }
}

class RtcTokenBuilder2
{
    const ROLE_PUBLISHER = 1;
    const ROLE_SUBSCRIBER = 2;

    /**
     * Build token with UID
     */
    public static function buildTokenWithUid($appId, $appCertificate, $channelName, $uid, $role, $tokenExpire, $privilegeExpire = 0)
    {
        $token = new AccessToken2($appId, $appCertificate, $tokenExpire);
        $serviceRtc = new ServiceRtc($channelName, $uid);

        $serviceRtc->addPrivilege(ServiceRtc::PRIVILEGE_JOIN_CHANNEL, $privilegeExpire);
        if ($role == self::ROLE_PUBLISHER) {
            $serviceRtc->addPrivilege(ServiceRtc::PRIVILEGE_PUBLISH_AUDIO_STREAM, $privilegeExpire);
            $serviceRtc->addPrivilege(ServiceRtc::PRIVILEGE_PUBLISH_VIDEO_STREAM, $privilegeExpire);
            $serviceRtc->addPrivilege(ServiceRtc::PRIVILEGE_PUBLISH_DATA_STREAM, $privilegeExpire);
        }
        $token->addService($serviceRtc);

        return $token->build();
    }
}
