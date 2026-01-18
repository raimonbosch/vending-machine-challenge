<?php

namespace VendingMachine\Domain\ValueObjects\Products;

use VendingMachine\Domain\ValueObjects\Product;

class Water implements Product
{
    public const NAME = 'WATER';

    public function priceInCents(): int
    {
        return 65;
    }

    public function name(): string
    {
        return self::NAME;
    }
}