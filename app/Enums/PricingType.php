<?php

namespace App\Enums;

class PricingType
{
    const FIXED    = 'fixed';
    const PER_M2   = 'per_m2';
    const HOURLY   = 'hourly';
    const PER_UNIT = 'per_unit';

    const ALL = [self::FIXED, self::PER_M2, self::HOURLY, self::PER_UNIT];

    // Turkish labels
    const LABELS = [
        self::FIXED    => 'Sabit (Paket)',
        self::PER_M2   => 'Metrekare',
        self::HOURLY   => 'Saatlik',
        self::PER_UNIT => 'Adet',
    ];

    // Unit suffix shown in UI
    const UNIT_SUFFIX = [
        self::FIXED    => '',
        self::PER_M2   => '₺/m²',
        self::HOURLY   => '₺/saat',
        self::PER_UNIT => '₺/adet',
    ];

    // Quantity label shown to customer when placing order
    const QUANTITY_LABEL = [
        self::FIXED    => '',
        self::PER_M2   => 'm²',
        self::HOURLY   => 'Saat',
        self::PER_UNIT => 'Adet',
    ];

    public static function label(string $type): string
    {
        return self::LABELS[$type] ?? self::LABELS[self::FIXED];
    }

    public static function unitSuffix(string $type): string
    {
        return self::UNIT_SUFFIX[$type] ?? '';
    }

    public static function isFixed(string $type): bool
    {
        return $type === self::FIXED;
    }

    public static function requiresQuantity(string $type): bool
    {
        return $type !== self::FIXED;
    }
}
