<?php
namespace App\Services;


use App\Exception\AlgorithmNotFoundException;
use App\Services\HashStrategies\AbstractHashStrategy;
use App\Services\HashStrategies\HashStrategyInterface;

/**
 * Class HashService
 * @package App\Services
 */
class HashService
{
    /**
     * @var string
     */
    protected $currentHashAlgrthm;

    /**
     * @var array
     */
    protected $hashStrategies;

    /**
     * @var HashStrategyInterface
     */
    protected $currentHashStrategy;

    /**
     * HashService constructor.
     * @param $hashStrategies
     * @param string $hashAlgorithm
     * @throws AlgorithmNotFoundException
     */
    public function __construct($hashStrategies, string $hashAlgorithm)
    {
        foreach ($hashStrategies as $hashStrategy) {
            $hashClassName = get_class($hashStrategy);
            $this->hashStrategies[$hashClassName] = $hashStrategy;
        }

        $this->currentHashAlgrthm = $hashAlgorithm;

        $this->init($hashAlgorithm);
    }

    /**
     * @param string $stringToHash
     * @return HashResponse
     */
    public function hash(string $stringToHash): HashResponse
    {
        return $this->currentHashStrategy->hash($stringToHash);
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