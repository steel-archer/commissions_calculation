<?php

namespace SteelArcher\CommissionsCalculation\Services\BinResolver;

use DomainException;
use JsonException;
use SteelArcher\CommissionsCalculation\Services\FileFetcher;

class BinlistBinResolver implements BinResolverInterface
{
    protected string $uri;

    public function __construct(protected FileFetcher $fileFetcher)
    {
        $this->uri = $_ENV['BINLIST_URI'] ?? '';
        if (!$this->uri) {
            throw new DomainException('Please set BINLIST_URI environment variable.');
        }
    }

    /**
     * @throws JsonException
     */
    public function getCountryAlpha2ByBin(string $bin): string
    {
        $rawContent = trim($this->fileFetcher->getContents($this->uri . $bin));

        if (empty($rawContent)) {
            throw new DomainException('Unable to retrieve bin data.');
        }

        $content = json_decode($rawContent, true, 512, JSON_THROW_ON_ERROR);

        $alpha2 = $content['country']['alpha2'] ?? '';
        if (empty($alpha2) || strlen($alpha2) !== 2) {
            throw new DomainException("Bin country is absent or not valid, `$alpha2` returned");
        }

        return $alpha2;
    }
}
