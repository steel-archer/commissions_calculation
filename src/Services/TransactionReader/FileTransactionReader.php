<?php

namespace SteelArcher\CommissionsCalculation\Services\TransactionReader;

use JsonException;
use RuntimeException;
use SteelArcher\CommissionsCalculation\Services\CommissionCalculationArgs\CommissionCalculationArgs;
use SteelArcher\CommissionsCalculation\Services\CommissionCalculationArgs\CommissionCalculationArgsInterface;

class FileTransactionReader implements TransactionReaderInterface
{
    protected const ERROR_WRONG_CLASS = 'Args must be of CommissionCalculationArgs, %d provided.';

    /**
     * @throws JsonException
     */
    public function readTransactionData(CommissionCalculationArgs|CommissionCalculationArgsInterface $args): Iterable
    {
        if (!($args instanceof CommissionCalculationArgs)) {
            throw new RuntimeException(sprintf(self::ERROR_WRONG_CLASS, get_class($args)));
        }

        $filename = $args->getFilename();
        if (!$filename) {
            throw new RuntimeException('No transaction data file provided.');
        }

        $handle = fopen($filename, 'rb');
        if (!$handle) {
            throw new RuntimeException("Cannot open file: $filename.");
        }

        try {
            while (($line = fgets($handle)) !== false) {
                yield json_decode(trim($line), true, 512, JSON_THROW_ON_ERROR);
            }
        } finally {
            fclose($handle);
        }

        return [];
    }
}
