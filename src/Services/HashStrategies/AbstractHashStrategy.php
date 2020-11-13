<?php


namespace App\Services\HashStrategies;


/**
 * Class AbstractHashStrategy
 * @package App\Services\HashStrategies
 */
abstract class AbstractHashStrategy implements HashStrategyInterface
{
    /**
     * @return string
     */
    public static function getNamespace(): string
    {
        return __NAMESPACE__ . '\\';
    }
}