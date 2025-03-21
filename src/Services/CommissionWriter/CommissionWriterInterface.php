<?php

namespace SteelArcher\CommissionsCalculation\Services\CommissionWriter;

interface CommissionWriterInterface
{
    public function writeCommission(float $commission): void;

    public function writeErrors(array $errors): void;
}
