<?php


namespace App\DTO;


/**
 * Class HashResponse
 * @package App\DTO
 */
class HashResponse
{

    /**
     * @var string
     */
    protected $hashedString;

    /**
     * @var string|null
     */
    protected $secretKey;

    /**
     * HashResponse constructor.
     * @param string $hashedString
     * @param string|null $secretKey
     */
    public function __construct(string $hashedString, string $secretKey = null)
    {
        $this->hashedString = $hashedString;
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getHashedString(): string
    {
        return $this->hashedString;
    }

    /**
     * @return string|null
     */
    public function getSecretKey(): ?string
    {
        return $this->secretKey;
    }
}