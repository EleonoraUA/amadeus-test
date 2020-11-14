<?php
namespace App\Services;


use App\Event\HashedStringEvent;
use App\Exception\AlgorithmNotFoundException;
use App\Services\HashStrategies\AbstractHashStrategy;
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
     * @param $hashStrategies
     * @param string $hashAlgorithm
     * @param EventDispatcherInterface $eventDispatcher
     * @throws AlgorithmNotFoundException
     */
    public function __construct($hashStrategies, string $hashAlgorithm, EventDispatcherInterface $eventDispatcher)
    {
        foreach ($hashStrategies as $hashStrategy) {
            $hashClassName = get_class($hashStrategy);
            $this->hashStrategies[$hashClassName] = $hashStrategy;
        }

        $this->eventDispatcher = $eventDispatcher;

        $this->init($hashAlgorithm);
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

    /**
     * @param string $hashAlgorithm
     * @throws AlgorithmNotFoundException
     */
    protected function init(string $hashAlgorithm): void
    {
        $hashClassName = AbstractHashStrategy::getNamespace() . ucfirst($hashAlgorithm) . 'HashStrategy';

        if (!isset($this->hashStrategies[$hashClassName])) {
            throw new AlgorithmNotFoundException();
        }

        $this->currentHashStrategy = $this->hashStrategies[$hashClassName];
    }
}