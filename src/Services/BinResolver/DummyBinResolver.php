<?php

namespace SteelArcher\CommissionsCalculation\Services\BinResolver;

use DomainException;

class DummyBinResolver implements BinResolverInterface
{
    public function getCountryAlpha2ByBin(string $bin): string
    {
        return match ($bin) {
            '516793', '4745030' => 'LT',
            '41417360' => 'US',
            '45417360' => 'JP',
            '45717360' => 'DK',
            default => throw new DomainException("Can't get country by bin: $bin."),
        };
    }
}
