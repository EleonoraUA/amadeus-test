<?php


namespace App\Services\HashStrategies;


use App\DTO\HashResponse;

/**
 * Class Sha1HashStrategy
 * @package App\Services\HashStrategies
 */
class Sha1HashStrategy extends AbstractHashStrategy
{
    /**
     * @param string $stringToHash
     * @return HashResponse
     */
    public function hash(string $stringToHash): HashResponse
    {
        return new HashResponse(sha1($stringToHash));
    }
}