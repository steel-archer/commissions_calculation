<?php

use SteelArcher\CommissionsCalculation\Services\BinResolver\BinlistBinResolver;
use SteelArcher\CommissionsCalculation\Services\BinResolver\DummyBinResolver;
use SteelArcher\CommissionsCalculation\Services\Calculator\Calculator;
use SteelArcher\CommissionsCalculation\Services\CommissionCalculation\CommissionCalculation;
use SteelArcher\CommissionsCalculation\Services\CommissionCalculationArgs\CommissionCalculationArgs;
use SteelArcher\CommissionsCalculation\Services\CommissionWriter\ConsoleCommissionWriter;
use SteelArcher\CommissionsCalculation\Services\CountryHelper;
use SteelArcher\CommissionsCalculation\Services\ExchangeRateResolver\ApiLayerExchangeRateResolver;
use SteelArcher\CommissionsCalculation\Services\ExchangeRateResolver\DummyExchangeRateResolver;
use SteelArcher\CommissionsCalculation\Services\FileFetcher;
use SteelArcher\CommissionsCalculation\Services\TransactionReader\FileTransactionReader;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$calculationArgs = $argv[1] ?? null;
$options = getopt('', ['dummy']);
$isDummy = in_array('--dummy', $argv, true);

$fileFetcher = new FileFetcher();

$calculator = new Calculator(new CountryHelper());

$commissionCalculation = new CommissionCalculation(
    $calculator,
    new CommissionCalculationArgs($calculationArgs),
    $isDummy ? new DummyBinResolver() : new BinlistBinResolver($fileFetcher),
    $isDummy ? new DummyExchangeRateResolver() : new ApiLayerExchangeRateResolver($fileFetcher),
    new FileTransactionReader(),
    new ConsoleCommissionWriter()
);

$commissionCalculation->processTransaction();
