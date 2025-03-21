<?php

namespace SteelArcher\CommissionsCalculation\Services\BinResolver;

interface BinResolverInterface
{
    public function getCountryAlpha2ByBin(string $bin): string;
}
