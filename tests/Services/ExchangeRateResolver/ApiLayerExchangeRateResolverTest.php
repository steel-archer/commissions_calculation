<?php

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception as MockException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SteelArcher\CommissionsCalculation\Services\ExchangeRateResolver\ApiLayerExchangeRateResolver;
use SteelArcher\CommissionsCalculation\Services\FileFetcher;

#[CoversClass(ApiLayerExchangeRateResolver::class)]
class ApiLayerExchangeRateResolverTest extends TestCase
{
    protected FileFetcher|MockObject $fileFetcher;

    /**
     * @throws MockException
     */
    protected function setUp(): void
    {
        $this->fileFetcher = $this->createMock(FileFetcher::class);
        $_ENV['APILAYER_API_KEY'] = 'some_api_key';
        $_ENV['APILAYER_URI'] = 'some_api_uri';
    }

    public function testNoApiKey(): void
    {
        unset($_ENV['APILAYER_API_KEY']);
        $this->expectExceptionObject(new DomainException('Please set APILAYER_API_KEY environment variable.'));
        new ApiLayerExchangeRateResolver($this->fileFetcher);
    }

    public function testNoUri(): void
    {
        unset($_ENV['APILAYER_URI']);
        $this->expectExceptionObject(new DomainException('Please set APILAYER_URI environment variable.'));
        new ApiLayerExchangeRateResolver($this->fileFetcher);
    }

    /**
     * @throws JsonException
     */
    public function testNoExchangeRates(): void
    {
        $this->fileFetcher->method('getContents')->willReturn('');
        $resolver = new ApiLayerExchangeRateResolver($this->fileFetcher);
        $this->expectExceptionObject(new DomainException('Unable to retrieve exchange rates.'));
        $resolver->getExchangeRates();
    }

    /**
     * @throws JsonException
     */
    public function testEmptyRates(): void
    {
        $this->fileFetcher->method('getContents')->willReturn('{}');
        $resolver = new ApiLayerExchangeRateResolver($this->fileFetcher);
        $this->expectExceptionObject(new DomainException('Exchange rates are empty.'));
        $resolver->getExchangeRates();
    }

    /**
     * @throws JsonException
     */
    public function testSuccess(): void
    {
        $content = file_get_contents(__DIR__ . '/stub.json');
        $this->fileFetcher->method('getContents')->willReturn($content);
        $resolver = new ApiLayerExchangeRateResolver($this->fileFetcher);
        self::assertEquals(
            [
                'EUR' => 1,
                'UAH' => 45,
            ],
            $resolver->getExchangeRates(),
        );
    }
}
