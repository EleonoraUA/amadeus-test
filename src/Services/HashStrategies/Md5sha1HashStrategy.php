<?php


namespace App\Services\HashStrategies;


use App\Services\HashResponse;

/**
 * Class Md5sha1HashStrategy
 * @package App\Services\HashStrategies
 */
class Md5sha1HashStrategy extends AbstractHashStrategy
{
    /**
     * @param string $stringToHash
     * @return HashResponse
     */
    public function hash(string $stringToHash): HashResponse
    {
        return new HashResponse(md5(sha1($stringToHash)));
    }
}