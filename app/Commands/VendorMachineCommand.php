<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\CLI\Commands;
use Psr\Log\LoggerInterface;
use VendorMachine\Application\VendorMachineUseCase;

class VendorMachineCommand extends BaseCommand
{
    protected $group = 'VendorMachine';
    protected $name = 'vendor_machine:run';
    protected $description = 'Test command';

    public function __construct(LoggerInterface $logger, Commands $commands)
    {
        parent::__construct($logger, $commands);
    }

    public function run(array $params)
    {
        /** @var VendorMachineUseCase $useCase */
        $useCase = service('VendorMachineUseCase');
        CLI::write($useCase->execute("whatever"));
    }
}