<?php

namespace VendorMachine\Application\Services;

use VendorMachine\Domain\Exceptions\InvalidActionException;
use VendorMachine\Domain\Exceptions\InvalidCoinException;
use VendorMachine\Domain\ValueObjects\Action;
use VendorMachine\Domain\ValueObjects\Coin;

class VendorMachineParserService
{
    /**
     * @throws InvalidCoinException
     * @throws InvalidActionException
     */
    public function execute(string $input): array {
        $outputElements = [];
        $elements = explode(',', $input);
        foreach ($elements as $element) {
            $element = trim($element);
            if ($this->isCoin($element)) {
                $outputElements []= new Coin($element);
            }

            if ($this->isAction($element)) {
                $outputElements []= new Action($element);
            }
        }

        return $outputElements;
    }

    private function isCoin(string $element): bool {
        return Coin::isValid($element);
    }

    private function isAction(string $element): bool {
        return Action::isValid($element);
    }
}