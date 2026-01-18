<?php

namespace VendingMachine\Application\Dto;

use VendingMachine\Domain\ValueObjects\Action;
use VendingMachine\Domain\ValueObjects\Coin;

class VendingMachineParserResponseDTO
{
    /**
     * @param Action|null $action
     * @param Coin[] $coins
     */
    public function __construct(
        public readonly ?Action $action,
        public readonly array $coins
    ) {
    }
}