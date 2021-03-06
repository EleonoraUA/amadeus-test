<?php


namespace App\Services\LoggerStrategies;


use App\DTO\HashResponse;

/**
 * Interface LoggerStrategyInterface
 * @package App\Services\LoggerStrategies
 */
interface LoggerStrategyInterface
{
    /**
     * @param string $inputString
     * @param HashResponse $response
     * @return mixed
     */
    public function log(string $inputString, HashResponse $response);
}