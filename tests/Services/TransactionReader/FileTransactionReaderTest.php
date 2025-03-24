<?php

namespace TransactionReader;

use JsonException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use SteelArcher\CommissionsCalculation\Services\CommissionCalculationArgs\CommissionCalculationArgs;
use SteelArcher\CommissionsCalculation\Services\Transaction\Transaction;
use SteelArcher\CommissionsCalculation\Services\TransactionReader\FileTransactionReader;

#[CoversClass(CommissionCalculationArgs::class)]
#[CoversClass(FileTransactionReader::class)]
#[CoversClass(Transaction::class)]
class FileTransactionReaderTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function testNoFilename(): void
    {
        $args = new CommissionCalculationArgs();
        $this->expectExceptionObject(new RuntimeException('No transaction data file provided.'));
        $fileTransactionReader = new FileTransactionReader();
        foreach ($fileTransactionReader->readTransactionData($args) as $transactionData) {
            self::assertEmpty($transactionData);
        }
    }

    /**
     * @throws JsonException
     */
    public function testNoFile(): void
    {
        $args = new CommissionCalculationArgs('foo.txt');
        $this->expectExceptionObject(new RuntimeException("Cannot open file: foo.txt."));
        $fileTransactionReader = new FileTransactionReader();
        foreach ($fileTransactionReader->readTransactionData($args) as $transactionData) {
            self::assertEmpty($transactionData);
        }
    }

    /**
     * @throws JsonException
     */
    public function testValidationFailures(): void
    {
        $args = new CommissionCalculationArgs(__DIR__ . '/incorrect.txt');
        $fileTransactionReader = new FileTransactionReader();
        $errors = [
            'Bin must be integer.',
            'Amount must be numeric.',
            'Currency must contain 3 characters.',
        ];
        $this->expectExceptionObject(
            new RuntimeException('Validation errors: ' . implode(', ', $errors))
        );
        foreach ($fileTransactionReader->readTransactionData($args) as $transactionData) {
            self::assertEmpty($transactionData);
        }
    }

    /**
     * @throws JsonException
     */
    public function testSuccess(): void
    {
        $args = new CommissionCalculationArgs(__DIR__ . '/correct.txt');
        $fileTransactionReader = new FileTransactionReader();
        foreach ($fileTransactionReader->readTransactionData($args) as $transactionData) {
            self::assertEquals(
                new Transaction(
                    '45717360',
                    100.00,
                    'EUR',
                ),
                $transactionData,
            );
        }
    }
}
