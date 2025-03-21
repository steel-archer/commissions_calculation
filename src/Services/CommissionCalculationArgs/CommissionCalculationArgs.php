<?php

namespace SteelArcher\CommissionsCalculation\Services\CommissionCalculationArgs;

class CommissionCalculationArgs implements CommissionCalculationArgsInterface
{
    protected ?string $filename;

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): CommissionCalculationArgs
    {
        $this->filename = $filename;

        return $this;
    }

    public function __construct(...$args)
    {
        $filename = $args[0] ?? null;
        $this->setFilename($filename);
    }
}
