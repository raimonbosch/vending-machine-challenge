<?php

namespace VendorMachine\Domain\ValueObjects;

use VendorMachine\Domain\Exceptions\InvalidActionException;

class Action {
    const acceptedActions = [
        'GET-SODA',
        'GET-WATER',
        'GET-JUICE',
        'RETURN-COIN',
        'SERVICE'
    ];

    public function __construct(string $action) {
        if (!self::isValid($action)) {
            throw new InvalidActionException();
        }
    }

    public static function isValid(string $action): bool {
        return in_array($action, self::acceptedActions);
    }
}
