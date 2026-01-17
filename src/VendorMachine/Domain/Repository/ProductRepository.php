<?php

namespace VendorMachine\Domain\Repository;

use VendorMachine\Domain\ValueObjects\Product;

interface ProductRepository
{
    public function add(Product $product): void;

    public function deliver(string $productName): Product;

    public function recharge(array $products): void;

    /**
     * @return Product[]
     */
    public function getAvailableProducts(): array;

    public function numberOfProducts(): int;
}