<?php

use SteelArcher\CommissionsCalculation\Services\BinResolver\BinlistBinResolver;
use SteelArcher\CommissionsCalculation\Services\CommisionCalculation\CommissionCalculation;
use SteelArcher\CommissionsCalculation\Services\CommissionWriter\ConsoleCommissionWriter;
use SteelArcher\CommissionsCalculation\Services\CountryHelper;
use SteelArcher\CommissionsCalculation\Services\ExchangeRateResolver\ApiLayerExchangeRateResolver;
use SteelArcher\CommissionsCalculation\Services\TransactionReader\FileTransactionReader;

require __DIR__ . '/vendor/autoload.php';

$args = $argv[1] ?? null;

$commissionCalculation = new CommissionCalculation(
    new BinlistBinResolver(),
    new ApiLayerExchangeRateResolver(),
    new CountryHelper(),
    new FileTransactionReader(),
    new ConsoleCommissionWriter()
);

$commissionCalculation->processTransaction($args);
