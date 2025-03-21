<?php

namespace SteelArcher\CommissionsCalculation\Services\BinResolver;

class DummyBinResolver implements BinResolverInterface
{
    public function getCountryAlpha2ByBin(string $bin): string
    {
        // @todo add more
        return match ($bin) {
            '45717360' => 'DK',
            default => 'LT',
        };
    }
}
