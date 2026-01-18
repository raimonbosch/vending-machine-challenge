<?php

namespace VendingMachine\Domain\Repository;

use VendingMachine\Domain\ValueObjects\Coin;

interface CoinRepository
{
    public function add(Coin $coin);

    /**
     * @param float $amount
     * @return Coin[]
     */
    public function subtract(int $cents): array;

    /**
     * @return Coin[]
     */
    public function withdrawChange(): array;

    /**
     * @param Coin[] $coins
     */
    public function recharge(array $coins): void;

    public function availableChange(): int;
}