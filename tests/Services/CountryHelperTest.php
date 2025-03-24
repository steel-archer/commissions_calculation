<?php

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use SteelArcher\CommissionsCalculation\Services\CountryHelper;

#[CoversClass(CountryHelper::class)]
class CountryHelperTest extends TestCase
{
    /**
     * @dataProvider isEuCountryDataProvider
     */
    public function testIsEuCountry(string $code, bool $isEu): void
    {
        self::assertEquals($isEu, CountryHelper::isEuCountry($code));
    }

    public static function isEuCountryDataProvider(): array
    {
        return [
            ['LT', true],
            ['fr', true],
            ['us', false]
        ];
    }
}
