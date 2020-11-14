<?php


namespace App\Services;


use App\Services\LoggerStrategies\AbstractLoggerStrategy;
use App\Services\LoggerStrategies\LoggerStrategyInterface;

/**
 * Class LoggerService
 * @package App\Services
 */
class LoggerService
{
    /**
     * @var array
     */
    protected $loggerStrategies;

    /**
     * @var LoggerStrategyInterface
     */
    protected $currentLogStrategy;

    /**
     * LoggerService constructor.
     * @param $loggerStrategies
     * @param string $logAlgorithm
     */
    public function __construct($loggerStrategies, string $logAlgorithm)
    {
        foreach ($loggerStrategies as $loggerStrategy) {
            $logClassName = get_class($loggerStrategy);
            $this->loggerStrategies[$logClassName] = $loggerStrategy;
        }

        $this->init($logAlgorithm);
    }


    /**
     * @param string $inputString
     * @param HashResponse $response
     */
    public function log(string $inputString, HashResponse $response): void
    {
        $this->currentLogStrategy->log($inputString, $response);
    }

    /**
     * @param string $logAlgorithm
     */
    protected function init(string $logAlgorithm): void
    {
        $logClassName = AbstractLoggerStrategy::getNamespace() . ucfirst($logAlgorithm) . 'LogStrategy';

        if (!isset($this->loggerStrategies[$logClassName])) {
            throw new AlgorithmNotFoundException();
        }

        $this->currentLogStrategy = $this->loggerStrategies[$logClassName];
    }
}