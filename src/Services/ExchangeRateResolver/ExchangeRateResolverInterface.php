<?php

namespace SteelArcher\CommissionsCalculation\Services\ExchangeRateResolver;

interface ExchangeRateResolverInterface
{
    public function getExchangeRates(): array;
}
