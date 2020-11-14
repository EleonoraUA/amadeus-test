<?php


namespace App\Services\LoggerStrategies;


use App\Services\HashResponse;

/**
 * Class AbstractLoggerStrategy
 * @package App\Services\LoggerStrategies
 */
abstract class AbstractLoggerStrategy implements LoggerStrategyInterface
{
    /**
     * @return string
     */
    public static function getNamespace(): string
    {
        return __NAMESPACE__ . '\\';
    }

    /**
     * @param string $inputString
     * @param HashResponse $response
     * @return string
     */
    protected function getMessage(string $inputString, HashResponse $response): string
    {
        return "Hashed input string: '$inputString', result: " . serialize($response) . PHP_EOL;
    }
}