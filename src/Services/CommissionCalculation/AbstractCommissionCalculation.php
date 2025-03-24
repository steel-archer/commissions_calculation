<?php

namespace SteelArcher\CommissionsCalculation\Services\CommissionCalculation;

use SteelArcher\CommissionsCalculation\Services\BinResolver\BinResolverInterface;
use SteelArcher\CommissionsCalculation\Services\Calculator\CalculatorInterface;
use SteelArcher\CommissionsCalculation\Services\CommissionCalculationArgs\CommissionCalculationArgsInterface;
use SteelArcher\CommissionsCalculation\Services\CommissionWriter\CommissionWriterInterface;
use SteelArcher\CommissionsCalculation\Services\CountryHelper;
use SteelArcher\CommissionsCalculation\Services\ExchangeRateResolver\ExchangeRateResolverInterface;
use SteelArcher\CommissionsCalculation\Services\TransactionReader\TransactionReaderInterface;

abstract class AbstractCommissionCalculation implements CommissionCalculationInterface
{
    public function __construct(
        protected CalculatorInterface $calculator,
        protected CommissionCalculationArgsInterface $args,
        protected BinResolverInterface $binResolver,
        protected ExchangeRateResolverInterface $exchangeRateResolver,
        protected TransactionReaderInterface $transactionReader,
        protected CommissionWriterInterface $commissionWriter
    ) {
    }

    abstract public function processTransaction(): void;
}
