<?php

namespace SteelArcher\CommissionsCalculation\Services\CommisionCalculation;

use SteelArcher\CommissionsCalculation\Services\BinResolver\BinResolverInterface;
use SteelArcher\CommissionsCalculation\Services\CommissionWriter\CommissionWriterInterface;
use SteelArcher\CommissionsCalculation\Services\CountryHelper;
use SteelArcher\CommissionsCalculation\Services\ExchangeRateResolver\ExchangeRateResolverInterface;
use SteelArcher\CommissionsCalculation\Services\TransactionReader\TransactionReaderInterface;

abstract class AbstractCommissionCalculation implements CommissionCalculationInterface
{
    public function __construct(
        protected BinResolverInterface $binResolver,
        protected ExchangeRateResolverInterface $exchangeRateResolver,
        protected CountryHelper $countryHelper,
        protected TransactionReaderInterface $transactionReader,
        protected CommissionWriterInterface $commissionWriter
    ) {
    }

    abstract public function processTransaction(...$args): void;
}
