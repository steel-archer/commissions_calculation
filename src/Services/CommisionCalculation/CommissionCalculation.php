<?php

namespace SteelArcher\CommissionsCalculation\Services\CommisionCalculation;

class CommissionCalculation extends AbstractCommissionCalculation
{
    public function processTransaction(...$args): void
    {
        var_dump($args); // @todo
        var_dump(get_class($this->binResolver));
        var_dump(get_class($this->exchangeRateResolver));
    }
}
