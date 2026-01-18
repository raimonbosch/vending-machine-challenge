<?php

namespace VendingMachine\Domain\ValueObjects\Products;

use VendingMachine\Domain\ValueObjects\Product;

class Juice implements Product
{
    public const NAME = 'JUICE';

    public function priceInCents(): int
    {
        return 100;
    }

    public function name(): string
    {
        return self::NAME;
    }
}