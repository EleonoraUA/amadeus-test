<?php
namespace App\Services;


use App\DTO\HashResponse;
use App\Event\HashedStringEvent;
use App\Services\HashStrategies\HashStrategyInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class HashService
 * @package App\Services
 */
class HashService
{
    /**
     * @var array
     */
    protected $hashStrategies;

    /**
     * @var HashStrategyInterface
     */
    protected $currentHashStrategy;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * HashService constructor.
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param HashStrategyInterface $currentHashStrategy
     * @return $this
     */
    public function setCurrentHashStrategy(HashStrategyInterface $currentHashStrategy): self
    {
        $this->currentHashStrategy = $currentHashStrategy;

        return $this;
    }

    /**
     * @param string $stringToHash
     * @return HashResponse
     */
    public function hash(string $stringToHash): HashResponse
    {
        $response = $this->currentHashStrategy->hash($stringToHash);

        $this->eventDispatcher->dispatch(new HashedStringEvent($stringToHash, $response), HashedStringEvent::NAME);

        return $response;
    }
}