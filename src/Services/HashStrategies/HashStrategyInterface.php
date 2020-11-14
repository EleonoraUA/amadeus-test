<?php
namespace App\Services\HashStrategies;


use App\DTO\HashResponse;

/**
 * Interface HashStrategyInterface
 * @package App\Services\HashStrategies
 */
interface HashStrategyInterface
{
    /**
     * @param string $stringToHash
     * @return HashResponse
     */
    public function hash(string $stringToHash): HashResponse;
}