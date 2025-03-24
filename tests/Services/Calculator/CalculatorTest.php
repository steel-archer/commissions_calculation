<?php

namespace SteelArcher\Tests\CommissionsCalculation\Services\Calculator;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use SteelArcher\CommissionsCalculation\Services\Calculator\AbstractCalculator;
use SteelArcher\CommissionsCalculation\Services\Calculator\Calculator;
use SteelArcher\CommissionsCalculation\Services\CountryHelper;
use SteelArcher\CommissionsCalculation\Services\Transaction\Transaction;

#[CoversClass(AbstractCalculator::class)]
#[CoversClass(Calculator::class)]
#[CoversClass(CountryHelper::class)]
#[CoversClass(Transaction::class)]
class CalculatorTest extends TestCase
{
    protected CountryHelper $countryHelper;
    protected Calculator $calculator;
    protected array $exchangeRates = [];

    protected function setUp(): void
    {
        $this->countryHelper = new CountryHelper();
        $this->calculator = new Calculator($this->countryHelper);
        $this->exchangeRates = [
            'EUR' => 1,
            'USD' => 1.082263,
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function test(Transaction $transaction, string $country, float $expected): void
    {
        self::assertEquals(
            $expected,
            $this->calculator->calculateCommission($transaction, $country, $this->exchangeRates),
        );
    }

    public static function dataProvider(): iterable
    {
        $transaction = new Transaction(
            "45717360",
            "100.00",
            "EUR",
        );
        $country = 'DK';
        $expected = 1;
        yield [$transaction, $country, $expected];

        $transaction = new Transaction(
            "41417360",
            "130.00",
            "USD",
        );
        $country = 'US';
        $expected = 2.41;
        yield [$transaction, $country, $expected];
    }
}
