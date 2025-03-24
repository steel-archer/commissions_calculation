<?php

namespace SteelArcher\CommissionsCalculation\Services\Calculator;

use SteelArcher\CommissionsCalculation\Services\Transaction\Transaction;

interface CalculatorInterface
{
    public function calculateCommission(Transaction $transaction, string $country, array $exchangeRates): float;
}
