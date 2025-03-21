<?php

namespace SteelArcher\CommissionsCalculation\Services\CommisionCalculation;

class CommissionCalculation extends AbstractCommissionCalculation
{
    public function processTransaction(...$args): void
    {
        print_r($args); // @todo
    }
}
