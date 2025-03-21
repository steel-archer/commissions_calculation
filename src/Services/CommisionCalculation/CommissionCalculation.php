<?php

namespace SteelArcher\CommissionsCalculation\Services\CommisionCalculation;

use Throwable;

class CommissionCalculation extends AbstractCommissionCalculation
{
    protected const EUR = 'EUR';
    protected const COMMISSION_EUR = 0.01;
    protected const COMMISSION_NON_EUR = 0.02;

    public function processTransaction(): void
    {
        $exchangeRates = $this->exchangeRateResolver->getExchangeRates();

        foreach ($this->transactionReader->readTransactionData($this->args) as $transaction) {
            try {
                $country = $this->binResolver->getCountryAlpha2ByBin($transaction->getBin());
                $isEu = $this->countryHelper::isEUCountry($country);
                $currency = $transaction->getCurrency();
                $rate = $exchangeRates[$currency];

                if ($currency === self::EUR || $rate === 0) {
                    $fixedAmount = $transaction->getAmount();
                } else {
                    $fixedAmount = $transaction->getAmount() / $rate;
                }

                $fixedAmount *= $isEu ? self::COMMISSION_EUR : self::COMMISSION_NON_EUR;
                $fixedAmount = self::ceilWithPrecision($fixedAmount);

                $this->commissionWriter->writeCommission($fixedAmount);
            } catch (Throwable $ex) {
                $this->commissionWriter->writeErrors([$ex->getMessage()]);
            }
        }
    }

    protected static function ceilWithPrecision(float $amount): float
    {
        // 100 = 10 ^ 2
        return ceil($amount * 100) / 100;
    }
}
