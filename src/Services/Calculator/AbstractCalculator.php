<?php

namespace SteelArcher\CommissionsCalculation\Services\Calculator;

use SteelArcher\CommissionsCalculation\Services\CountryHelper;

abstract class AbstractCalculator implements CalculatorInterface
{
    protected const EUR = 'EUR';
    protected const COMMISSION_EUR = 0.01;
    protected const COMMISSION_NON_EUR = 0.02;

    public function __construct(protected CountryHelper $countryHelper)
    {
    }
}
