<?php


namespace App\Services\LoggerStrategies;


use App\DTO\HashResponse;
use Psr\Log\LoggerInterface;

/**
 * Class MonologLogStrategy
 * @package App\Services\LoggerStrategies
 */
class MonologLogStrategy extends AbstractLoggerStrategy
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * MonologLogStrategy constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $inputString
     * @param HashResponse $response
     * @return mixed|void
     */
    public function log(string $inputString, HashResponse $response)
    {
        $this->logger->info($this->getMessage($inputString, $response));
    }
}