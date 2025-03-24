<?php

namespace BinResolver;

use DomainException;
use JsonException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception as MockException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SteelArcher\CommissionsCalculation\Services\BinResolver\BinlistBinResolver;
use SteelArcher\CommissionsCalculation\Services\FileFetcher;

#[CoversClass(BinlistBinResolver::class)]
class BinlistBinResolverTest extends TestCase
{
    protected FileFetcher|MockObject $fileFetcher;

    /**
     * @throws MockException
     */
    protected function setUp(): void
    {
        $this->fileFetcher = $this->createMock(FileFetcher::class);
        $_ENV['BINLIST_URI'] = 'some_api_uri';
    }

    public function testNoUri(): void
    {
        unset($_ENV['BINLIST_URI']);
        $this->expectExceptionObject(new DomainException('Please set BINLIST_URI environment variable.'));
        new BinlistBinResolver($this->fileFetcher);
    }

    /**
     * @throws JsonException
     */
    public function testNoBinData(): void
    {
        $this->fileFetcher->method('getContents')->willReturn('');
        $resolver = new BinlistBinResolver($this->fileFetcher);
        $this->expectExceptionObject(new DomainException('Unable to retrieve bin data'));
        $resolver->getCountryAlpha2ByBin('123456');
    }

    /**
     * @throws JsonException
     */
    public function testInvalidBinData(): void
    {
        $content = file_get_contents(__DIR__ . '/invalid_stub.json');
        $this->fileFetcher->method('getContents')->willReturn($content);
        $resolver = new BinlistBinResolver($this->fileFetcher);
        $this->expectExceptionObject(new DomainException("Bin country is absent or not valid, `FOO` returned"));
        $resolver->getCountryAlpha2ByBin('123456');
    }

    /**
     * @throws JsonException
     */
    public function testValidBinData(): void
    {
        $content = file_get_contents(__DIR__ . '/valid_stub.json');
        $this->fileFetcher->method('getContents')->willReturn($content);
        $resolver = new BinlistBinResolver($this->fileFetcher);
        self::assertEquals(
            'DK',
            $resolver->getCountryAlpha2ByBin('123456'),
        );
    }
}
