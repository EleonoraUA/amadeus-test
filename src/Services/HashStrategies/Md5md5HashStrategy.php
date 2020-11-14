<?php


namespace App\Services\HashStrategies;


use App\DTO\HashResponse;

/**
 * Class Md5md5HashStrategy
 * @package App\Services\HashStrategies
 */
class Md5md5HashStrategy extends AbstractHashStrategy
{
    /**
     * @param string $stringToHash
     * @return HashResponse
     */
    public function hash(string $stringToHash): HashResponse
    {
        return new HashResponse(md5(md5($stringToHash)));
    }
}