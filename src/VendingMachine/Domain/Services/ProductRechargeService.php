<?php

namespace VendingMachine\Domain\Services;

use VendingMachine\Domain\ValueObjects\Products\Juice;
use VendingMachine\Domain\ValueObjects\Products\Soda;
use VendingMachine\Domain\ValueObjects\Products\Water;

class ProductRechargeService
{
    public function getRechargeProducts(): array
    {
        return array_merge(
            array_fill(0, 15,  new Soda()),
            array_fill(0, 5, new Juice()),
            array_fill(0, 20, new Water()),
        );
    }
}