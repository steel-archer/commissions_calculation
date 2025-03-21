<?php

namespace SteelArcher\CommissionsCalculation\Services\BinResolver;

class DummyBinResolver implements BinResolverInterface
{
    public function getCountryAlpha2ByBin(string $bin): string
    {
        return match ($bin) {
            '45717360' => 'DK',
            default => 'LT',
        };
    }
}
