<?php

namespace VendorMachine\Domain\ValueObjects;

use VendorMachine\Domain\Exceptions\InvalidCoinException;

class Coin {
    private $cents;

    public const acceptedCoins = [
        '0.05',
        '0.10',
        '0.25',
        '1'
    ];

    /**
     * @throws InvalidCoinException
     */
    public function __construct(string $coin) {
        if (!is_numeric($coin)) {
            throw new InvalidCoinException("Invalid coin");
        }

        if (!self::isValid($coin)) {
            throw new InvalidCoinException("Coin value is not accepted");
        }

        $this->cents = (int)(100*((float) $coin));
    }

    public static function isValid(string $action): bool {
        return in_array($action, self::acceptedCoins);
    }

    public function getCents(): int {
        return $this->cents;
    }
}
