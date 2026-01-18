<?php

namespace VendingMachine\Domain\ValueObjects\Products;

use VendingMachine\Domain\ValueObjects\Product;

class Soda implements Product
{
    public const NAME = 'SODA';

    public function priceInCents(): int
    {
        return 150;
    }

    public function name(): string
    {
        return self::NAME;
    }
}