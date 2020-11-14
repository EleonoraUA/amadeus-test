<?php


namespace App\Event;


use App\Services\HashResponse;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class HashedStringEvent
 * @package App\Event
 */
class HashedStringEvent extends Event
{
    public const NAME = 'hashed.string';

    /**
     * @var string
     */
    protected $inputString;

    /**
     * @var HashResponse
     */
    protected $result;

    /**
     * HashedStringEvent constructor.
     * @param string $inputString
     * @param HashResponse $result
     */
    public function __construct(string $inputString, HashResponse $result)
    {
        $this->inputString = $inputString;
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getInputString(): string
    {
        return $this->inputString;
    }

    /**
     * @return HashResponse
     */
    public function getResult(): HashResponse
    {
        return $this->result;
    }
}