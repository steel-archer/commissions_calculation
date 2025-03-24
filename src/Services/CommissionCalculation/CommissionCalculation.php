<?php

namespace SteelArcher\CommissionsCalculation\Services\CommissionCalculation;

use Throwable;

class CommissionCalculation extends AbstractCommissionCalculation
{
    public function processTransaction(): void
    {
        $exchangeRates = $this->exchangeRateResolver->getExchangeRates();

        foreach ($this->transactionReader->readTransactionData($this->args) as $transaction) {
            try {
                $country = $this->binResolver->getCountryAlpha2ByBin($transaction->getBin());
                $fixedAmount = $this->calculator->calculateCommission($transaction, $country, $exchangeRates);

                $this->commissionWriter->writeCommission($fixedAmount);
            } catch (Throwable $ex) {
                $this->commissionWriter->writeErrors([$ex->getMessage()]);
            }
        }
    }
}
