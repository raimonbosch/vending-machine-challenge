<?php

namespace Tests\VendorMachine\Domain\Services;

use CodeIgniter\Test\CIUnitTestCase;
use VendorMachine\Domain\Services\CoinAllocationService;
use VendorMachine\Domain\ValueObjects\Coin;

class CoinAllocationServiceTest extends CIUnitTestCase
{
    private CoinAllocationService $sut;

    protected function setUp(): void
    {
        $this->sut = new CoinAllocationService();
    }
    /**
     * @dataProvider allocationProvider
     */
    public function testAllocations(array $availableCoins, int $amount, array $expected): void
    {
        $result = $this->sut->allocateCoins($availableCoins, $amount);

        $this->assertEquals($expected, $result);
    }

    public static function allocationProvider(): array
    {
        return [
            'exact 1 euro' => [
                [new Coin(1)],
                100,
                [new Coin(1)],
            ],

            'two quarters' => [
                [new Coin(0.25), new Coin(0.25)],
                50,
                [new Coin(0.25), new Coin(0.25)],
            ],

            'mixed coins' => [
                [new Coin(1), new Coin(0.25), new Coin(0.10), new Coin(0.05)],
                40,
                [new Coin(0.25), new Coin(0.10), new Coin(0.05)],
            ],

            'insufficient amount returns empty' => [
                [new Coin(0.10)],
                50,
                [],
            ],

            'zero amount returns empty' => [
                [new Coin(1), new Coin(0.25)],
                0,
                [],
            ],
        ];
    }
}