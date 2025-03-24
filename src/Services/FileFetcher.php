<?php

namespace SteelArcher\CommissionsCalculation\Services;

use RuntimeException;
use SteelArcher\CommissionsCalculation\Exceptions\TooManyRequestsException;

class FileFetcher
{
    protected const TOO_MANY_REQUESTS_ERROR = 'The requested URL returned error: 429';
    protected const TOO_MANY_REQUESTS_ERROR_MESSAGE = 'Too many requests. Try again later.';

    public function getContents(string $filename): string|false
    {
        $handle = curl_init($filename);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_FAILONERROR, true);

        $response = curl_exec($handle);
        if ($response === false) {
            $error = curl_error($handle);
            curl_close($handle);

            if (self::TOO_MANY_REQUESTS_ERROR === $error) {
                throw new TooManyRequestsException(self::TOO_MANY_REQUESTS_ERROR_MESSAGE);
            }

            throw new RuntimeException($error);
        }

        return $response;
    }
}
