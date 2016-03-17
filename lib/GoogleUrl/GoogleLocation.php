<?php

namespace GoogleUrl;

/**
 * Class GoogleLocation
 * @package GoogleUrl
 */
class GoogleLocation
{

    /**
     * Prefix for google parameter
     */
    const UULE_PREFIX = 'w+CAIQICI';

    /**
     * @var string
     */
    private $canonical;

    /**
     * GoogleLocation constructor.
     * @param $canonical
     */
    public function __construct($canonical)
    {
        $this->canonical = trim($canonical);
    }

    /**
     * Get encoded location parameter
     *
     * @return string
     * @throws Exception
     */
    public function getParam()
    {
        if (! $this->canonical) {
            throw new Exception('Canonical name is undefined');
        }

        return static::UULE_PREFIX
            . $this->getSecretKey()
            . base64_decode($this->canonical);
    }

    /**
     * @throws Exception
     * @return string
     */
    private function getSecretKey()
    {
        $matrix = [
            4  => 'E', 5  => 'F', 6  => 'G', 7  => 'H', 8  => 'I',
            9  => 'J', 10 => 'K', 11 => 'L', 12 => 'M', 13 => 'N',
            14 => 'O', 15 => 'P', 16 => 'Q', 17 => 'R', 18 => 'S',
            19 => 'T', 20 => 'U', 21 => 'V', 22 => 'W', 23 => 'X',
            24 => 'Y', 25 => 'Z', 26 => 'a', 27 => 'b', 28 => 'c',
            29 => 'd', 30 => 'e', 31 => 'f', 32 => 'g', 33 => 'h',
            34 => 'i', 35 => 'j', 36 => 'k', 37 => 'l', 38 => 'm',
            39 => 'n', 40 => 'o', 41 => 'p', 42 => 'q', 43 => 'r',
            44 => 's', 45 => 't', 46 => 'u', 47 => 'v', 48 => 'w',
            49 => 'x', 50 => 'y', 51 => 'z', 52 => '0', 53 => '1',
            54 => '2', 55 => '3', 56 => '4', 57 => '5', 58 => '6',
            59 => '7', 60 => '8', 61 => '9', 62 => '-', 63 => '',
            64 => 'A', 65 => 'B', 66 => 'C', 67 => 'D', 68 => 'E',
            69 => 'F', 70 => 'G', 71 => 'H', 72 => 'I', 73 => 'J',
            76 => 'M', 83 => 'T', 89 => 'L'
        ];

        $count = mb_strlen($this->canonical);

        if (! array_key_exists($count, $matrix)) {
            throw new Exception('Location: Secret key error - Can\'t find existing key');
        }

        return $matrix[$count];
    }

}