<?php

namespace Tests\VendingMachine\Domain\ValueObjects;

use CodeIgniter\Test\CIUnitTestCase;
use VendingMachine\Domain\Exceptions\InvalidActionException;
use VendingMachine\Domain\ValueObjects\Action;

class ActionTest extends CIUnitTestCase
{
    public function testValidAction(): void
    {
        $this->assertInstanceOf(Action::class, new Action('GET-SODA'));
    }

    public function testInvalidAction(): void
    {
        $this->expectException(InvalidActionException::class);

        new Action('Whatever');
    }
}