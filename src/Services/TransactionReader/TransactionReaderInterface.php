<?php

namespace SteelArcher\CommissionsCalculation\Services\TransactionReader;

use SteelArcher\CommissionsCalculation\Services\CommissionCalculationArgs\CommissionCalculationArgsInterface;

interface TransactionReaderInterface
{
    public function readTransactionData(CommissionCalculationArgsInterface $args): Iterable;
}
