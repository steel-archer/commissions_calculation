<?php

namespace SteelArcher\CommissionsCalculation\Services\Transaction;

use RuntimeException;

class Transaction implements TransactionInterface
{
    protected ?int $bin;
    protected ?float $amount;
    protected ?string $currency;

    public function getBin(): ?int
    {
        return $this->bin;
    }

    public function setBin(?int $bin): Transaction
    {
        $this->bin = $bin;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): Transaction
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): Transaction
    {
        $this->currency = $currency;

        return $this;
    }

    public function __construct(?int $bin = null, ?float $amount = null, ?string $currency = null)
    {
        $errors = [];

        if (!is_int($bin)) {
            $errors[] = 'Bin must be integer.';
        }
        if (!is_numeric($amount)) {
            $errors[] = 'Amount must be numeric.';
        }
        if (!is_string($currency) || strlen($currency) !== 3) {
            $errors[] = 'Currency must contain 3 characters.';
        }

        if (count($errors) > 0) {
            throw new RuntimeException('Validation errors: ' . implode(', ', $errors));
        }

        $this->setBin($bin);
        $this->setAmount($amount);
        $this->setCurrency($currency);
    }
}
