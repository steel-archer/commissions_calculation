<?php

namespace SteelArcher\CommissionsCalculation\Services\Calculator;

use SteelArcher\CommissionsCalculation\Services\Transaction\Transaction;

class Calculator extends AbstractCalculator
{
    public function calculateCommission(Transaction $transaction, string $country, array $exchangeRates): float
    {
        $isEu = $this->countryHelper::isEUCountry($country);
        $currency = $transaction->getCurrency();
        $rate = $exchangeRates[$currency];

        if ($currency === self::EUR || $rate === 0) {
            $fixedAmount = $transaction->getAmount();
        } else {
            $fixedAmount = $transaction->getAmount() / $rate;
        }

        $fixedAmount *= $isEu ? self::COMMISSION_EUR : self::COMMISSION_NON_EUR;

        return self::ceilWithPrecision($fixedAmount);
    }

    protected static function ceilWithPrecision(float $amount): float
    {
        // 100 = 10 ^ 2
        return ceil($amount * 100) / 100;
    }
}
