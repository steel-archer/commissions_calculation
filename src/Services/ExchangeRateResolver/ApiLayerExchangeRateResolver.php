<?php

namespace SteelArcher\CommissionsCalculation\Services\ExchangeRateResolver;

use DomainException;
use JsonException;
use SteelArcher\CommissionsCalculation\Services\FileFetcher;

class ApiLayerExchangeRateResolver implements ExchangeRateResolverInterface
{
    protected string $key;
    protected string $uri;

    public function __construct(protected FileFetcher $fileFetcher)
    {
        $this->key = $_ENV['APILAYER_API_KEY'] ?? '';
        if (!$this->key) {
            throw new DomainException('Please set APILAYER_API_KEY environment variable.');
        }

        $this->uri = $_ENV['APILAYER_URI'] ?? '';
        if (!$this->uri) {
            throw new DomainException('Please set APILAYER_URI environment variable.');
        }

        $this->uri .= $this->key;
    }

    /**
     * @throws JsonException
     */
    public function getExchangeRates(): array
    {
        $rawContent = trim($this->fileFetcher->getContents($this->uri));

        if (empty($rawContent)) {
            throw new DomainException('Unable to retrieve exchange rates.');
        }

        $content = json_decode($rawContent, true, 512, JSON_THROW_ON_ERROR);

        if (empty($content['rates'])) {
            throw new DomainException('Exchange rates are empty.');
        }

        // Filter retrieved result.
        return array_filter($content['rates'], static function ($rate, $currency) {
            return is_numeric($rate) && strlen($currency) === 3;
        }, ARRAY_FILTER_USE_BOTH);
    }
}
