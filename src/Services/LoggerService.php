<?php


namespace App\Services;


use App\DTO\HashResponse;
use App\Services\LoggerStrategies\AbstractLoggerStrategy;
use App\Services\LoggerStrategies\LoggerStrategyInterface;

/**
 * Class LoggerService
 * @package App\Services
 */
class LoggerService
{
    /**
     * @var LoggerStrategyInterface
     */
    protected $currentLogStrategy;

    /**
     * @param string $inputString
     * @param HashResponse $response
     */
    public function log(string $inputString, HashResponse $response): void
    {
        $this->currentLogStrategy->log($inputString, $response);
    }

    /**
     * @param LoggerStrategyInterface $currentLogStrategy
     * @return $this
     */
    public function setCurrentLogStrategy(LoggerStrategyInterface $currentLogStrategy): self
    {
        $this->currentLogStrategy = $currentLogStrategy;

        return $this;
    }
}