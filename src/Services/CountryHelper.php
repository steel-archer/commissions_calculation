<?php

namespace SteelArcher\CommissionsCalculation\Services;

class CountryHelper
{
    protected const EU_COUNTRY_CODES = [
        'AT',
        'BE',
        'BG',
        'CY',
        'CZ',
        'DE',
        'DK',
        'EE',
        'ES',
        'FI',
        'FR',
        'GR',
        'HR',
        'HU',
        'IE',
        'IT',
        'LT',
        'LU',
        'LV',
        'MT',
        'NL',
        'PO',
        'PT',
        'RO',
        'SE',
        'SI',
        'SK',
    ];

    public static function isEUCountry(string $countryCode): bool
    {
        return in_array(strtoupper($countryCode), self::EU_COUNTRY_CODES);
    }
}
