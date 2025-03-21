<?php

namespace SteelArcher\CommissionsCalculation\Services\CommisionCalculation;

class CommissionCalculation extends AbstractCommissionCalculation
{
    public function processTransaction(): void
    {
        $data = $this->transactionReader->readTransactionData($this->args);
        foreach ($data as $transaction) {
            var_dump($transaction); // @todo
        }
    }
}
