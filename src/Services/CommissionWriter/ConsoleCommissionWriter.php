<?php

namespace SteelArcher\CommissionsCalculation\Services\CommissionWriter;

class ConsoleCommissionWriter implements CommissionWriterInterface
{
    public function writeCommission(float $commission): void
    {
        echo $commission . PHP_EOL;
    }

    public function writeErrors(array $errors): void
    {
        echo 'Errors: ' . implode(', ', $errors) . PHP_EOL;
    }
}
