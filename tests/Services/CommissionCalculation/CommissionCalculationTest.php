<?php

namespace SteelArcher\Tests\CommissionsCalculation\Services\CommissionCalculation;

use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception as MockException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SteelArcher\CommissionsCalculation\Services\BinResolver\BinlistBinResolver;
use SteelArcher\CommissionsCalculation\Services\Calculator\Calculator;
use SteelArcher\CommissionsCalculation\Services\CommissionCalculation\AbstractCommissionCalculation;
use SteelArcher\CommissionsCalculation\Services\CommissionCalculation\CommissionCalculation;
use SteelArcher\CommissionsCalculation\Services\CommissionCalculationArgs\CommissionCalculationArgs;
use SteelArcher\CommissionsCalculation\Services\CommissionWriter\ConsoleCommissionWriter;
use SteelArcher\CommissionsCalculation\Services\ExchangeRateResolver\ApiLayerExchangeRateResolver;
use SteelArcher\CommissionsCalculation\Services\Transaction\Transaction;
use SteelArcher\CommissionsCalculation\Services\TransactionReader\FileTransactionReader;

#[CoversClass(AbstractCommissionCalculation::class)]
#[CoversClass(CommissionCalculation::class)]
#[CoversClass(Transaction::class)]
class CommissionCalculationTest extends TestCase
{
    protected MockObject|Calculator $calculator;
    protected MockObject|CommissionCalculationArgs $args;
    protected MockObject|BinlistBinResolver $binResolver;
    protected MockObject|ApiLayerExchangeRateResolver $exchangeRateResolver;
    protected MockObject|FileTransactionReader $transactionReader;
    protected MockObject|ConsoleCommissionWriter $commissionWriter;
    protected CommissionCalculation $commissionCalculation;

    /**
     * @throws MockException
     */
    protected function setUp(): void
    {
        $this->calculator = $this->createMock(Calculator::class);
        $this->args = $this->createMock(CommissionCalculationArgs::class);
        $this->binResolver = $this->createMock(BinlistBinResolver::class);
        $this->exchangeRateResolver = $this->createMock(ApiLayerExchangeRateResolver::class);
        $this->transactionReader = $this->createMock(FileTransactionReader::class);
        $this->commissionWriter = $this->createMock(ConsoleCommissionWriter::class);

        $this->commissionCalculation = new CommissionCalculation(
            $this->calculator,
            $this->args,
            $this->binResolver,
            $this->exchangeRateResolver,
            $this->transactionReader,
            $this->commissionWriter,
        );
    }

    public function testExchangeRatesError(): void
    {
        $exception = new Exception('Exception while resolving exchange rates.');
        $this->exchangeRateResolver
            ->method('getExchangeRates')
            ->willThrowException($exception);
        $this->commissionWriter
            ->expects(self::once())
            ->method('writeErrors')
            ->with([$exception->getMessage()]);
        $this->commissionCalculation->processTransaction();
    }

    public function testBinResolverError(): void
    {
        $this->setTransactionReader();

        $exception = new Exception('Exception while resolving bin data.');
        $this->binResolver
            ->method('getCountryAlpha2ByBin')
            ->willThrowException($exception);
        $this->commissionWriter
            ->expects(self::exactly(2))
            ->method('writeErrors')
            ->with([$exception->getMessage()]);
        $this->commissionCalculation->processTransaction();
    }

    public function testSuccess(): void
    {
        $this->setTransactionReader();
        $this->binResolver
            ->expects(self::exactly(2))
            ->method('getCountryAlpha2ByBin')
            ->willReturn('US');
        $this->calculator
            ->expects(self::exactly(2))
            ->method('calculateCommission')
            ->willReturn(1.0);
        $this->commissionWriter
            ->expects(self::exactly(2))
            ->method('writeCommission')
            ->with(1.0);
        $this->commissionCalculation->processTransaction();
    }

    protected function setTransactionReader(): void
    {
        $transactions = [
            new Transaction('123456', 100, 'USD'),
            new Transaction('654321', 1000, 'EUR'),
        ];
        $this->transactionReader
            ->expects(self::once())
            ->method('readTransactionData')
            ->willReturn($transactions);
    }
}
