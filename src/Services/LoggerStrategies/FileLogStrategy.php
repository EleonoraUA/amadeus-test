<?php


namespace App\Services\LoggerStrategies;


use App\DTO\HashResponse;

/**
 * Class FileLogStrategy
 * @package App\Services\LoggerStrategies
 */
class FileLogStrategy extends AbstractLoggerStrategy
{
    /**
     * @var string
     */
    protected $logFilePath;

    /**
     * FileLogStrategy constructor.
     * @param string $logFilePath
     */
    public function __construct(string $logFilePath)
    {
        $this->logFilePath = $logFilePath;
    }

    /**
     * @param string $inputString
     * @param HashResponse $response
     * @return mixed|void
     */
    public function log(string $inputString, HashResponse $response)
    {
        $filePath = __DIR__ . '/../../../' . $this->logFilePath;

        file_put_contents($filePath, $this->getMessage($inputString, $response), FILE_APPEND);
    }
}