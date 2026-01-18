<?php

namespace VendingMachine\Domain\ValueObjects;

interface Product
{
    public function priceInCents(): int;

    public function name(): string;
}