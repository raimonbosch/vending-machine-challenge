<?php

namespace Tests\VendingMachine\Infrastructure\Repository;

use CodeIgniter\Test\CIUnitTestCase;
use VendingMachine\Domain\Exceptions\ProductNotAvailableException;
use VendingMachine\Domain\ValueObjects\Products\Juice;
use VendingMachine\Domain\ValueObjects\Products\Water;
use VendingMachine\Infrastructure\Repository\ProductArrayRepository;

class ProductArrayRepositoryTest extends CIUnitTestCase
{
    private ProductArrayRepository $sut;

    protected function setUp(): void
    {
        $this->sut = new ProductArrayRepository();
    }

    public function testAddAndDeliver(): void
    {
        $juice = new Juice();

        $this->sut->add($juice);
        $this->assertEquals([$juice], $this->sut->getAvailableProducts());

        $product = $this->sut->deliver($juice->name());
        $this->assertEquals($juice, $product);
        $this->assertEquals([], $this->sut->getAvailableProducts());
    }

    public function testAddAndNoDeliver(): void
    {
        $this->expectException(ProductNotAvailableException::class);
        $juice = new Juice();
        $water = new Water();

        $this->sut->add($juice);
        $this->sut->deliver($water->name());
    }

}