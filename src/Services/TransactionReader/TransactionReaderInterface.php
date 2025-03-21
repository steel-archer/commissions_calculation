<?php

namespace SteelArcher\CommissionsCalculation\Services\TransactionReader;

use SteelArcher\CommissionsCalculation\Services\CommissionCalculationArgs\CommissionCalculationArgsInterface;
use SteelArcher\CommissionsCalculation\Services\Transaction\Transaction;

interface TransactionReaderInterface
{
    /**
     * @return iterable|Transaction[]
     */
    public function readTransactionData(CommissionCalculationArgsInterface $args): Iterable;
}
