<?php

namespace Tests\VendingMachine\Domain\ValueObjects;

use CodeIgniter\Test\CIUnitTestCase;
use VendingMachine\Domain\Exceptions\InvalidCoinException;
use VendingMachine\Domain\ValueObjects\Coin;

class CoinTest extends CIUnitTestCase
{
    public function testValidCoin(): void
    {
        $this->assertInstanceOf(Coin::class, new Coin('0.25'));
    }

    public function testInvalidCoin(): void
    {
        $this->expectException(InvalidCoinException::class);
        new Coin('0.20');
    }

    public function testNoNumericCoin(): void
    {
        $this->expectException(InvalidCoinException::class);
        new Coin('no_numeric');
    }
}