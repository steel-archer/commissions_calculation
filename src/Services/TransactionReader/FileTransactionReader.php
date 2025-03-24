<?php

namespace SteelArcher\CommissionsCalculation\Services\TransactionReader;

use JsonException;
use RuntimeException;
use SteelArcher\CommissionsCalculation\Services\CommissionCalculationArgs\CommissionCalculationArgs;
use SteelArcher\CommissionsCalculation\Services\CommissionCalculationArgs\CommissionCalculationArgsInterface;
use SteelArcher\CommissionsCalculation\Services\Transaction\Transaction;

class FileTransactionReader implements TransactionReaderInterface
{
    /**
     * @throws JsonException
     *
     * @return iterable|Transaction[]
     */
    public function readTransactionData(CommissionCalculationArgs|CommissionCalculationArgsInterface $args): Iterable
    {
        $filename = $args->getFilename();
        if (empty($filename)) {
            throw new RuntimeException('No transaction data file provided.');
        }

        $handle = @fopen($filename, 'rb');
        if (!$handle) {
            throw new RuntimeException("Cannot open file: $filename.");
        }

        try {
            while (($line = fgets($handle)) !== false) {
                $data = json_decode(trim($line), true, 512, JSON_THROW_ON_ERROR);
                $transaction = new Transaction(
                    $data['bin'] ?? null,
                    $data['amount'] ?? null,
                    $data['currency'] ?? null,
                );
                yield $transaction;
            }
        } finally {
            fclose($handle);
        }
    }
}
