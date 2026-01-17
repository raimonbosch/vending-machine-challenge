<?php

namespace Tests\VendorMachine\Infrastructure\Repository;

use CodeIgniter\Test\CIUnitTestCase;
use VendorMachine\Domain\Services\CoinAllocationService;
use VendorMachine\Domain\ValueObjects\Coin;
use VendorMachine\Infrastructure\Repository\CoinArrayRepository;

class CoinArrayRepositoryTest extends CIUnitTestCase
{
    private CoinArrayRepository $sut;

    protected function setUp(): void
    {
        $this->sut = new CoinArrayRepository(
            new CoinAllocationService()
        );
    }

    public function testAddAndSubtract(): void
    {
        $this->sut->add(new Coin('1'));
        $this->sut->add(new Coin('0.25'));
        $this->sut->add(new Coin('0.25'));

        $coins = $this->sut->subtract(125);

        $this->assertEquals([new Coin('1'), new Coin('0.25')], $coins);
        $this->assertEquals([new Coin('0.25')], $this->sut->getAvailableCoins());
    }

}