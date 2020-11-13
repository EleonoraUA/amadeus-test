<?php


namespace App\Services\HashStrategies;


use App\Services\HashResponse;

/**
 * Class Aes256HashStrategy
 * @package App\Services\HashStrategies
 */
class Aes256HashStrategy extends AbstractHashStrategy
{
    protected const CIPHER_ALGO = 'aes-256-cbc';

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * Aes256HashStrategy constructor.
     * @param string $encryptSecretKey
     */
    public function __construct(string $encryptSecretKey)
    {
        $this->secretKey = $encryptSecretKey;
    }

    /**
     * @param string $stringToHash
     * @return HashResponse
     */
    public function hash(string $stringToHash): HashResponse
    {
        $ivlen = openssl_cipher_iv_length(self::CIPHER_ALGO);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $hashedString = openssl_encrypt($stringToHash, self::CIPHER_ALGO, $this->secretKey, 0, $iv);

        return new HashResponse($hashedString, $this->secretKey);
    }
}