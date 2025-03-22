<?php

namespace SteelArcher\CommissionsCalculation\Services;

class FileFetcher
{
    public function getContents(string $filename): string|false
    {
        return file_get_contents($filename);
    }
}
