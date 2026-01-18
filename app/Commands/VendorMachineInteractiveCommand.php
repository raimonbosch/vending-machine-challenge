<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\CLI\Commands;
use Psr\Log\LoggerInterface;
use VendorMachine\Application\VendorMachineUseCase;
use VendorMachine\Domain\Exceptions\InvalidVendorMachineInputException;

class VendorMachineInteractiveCommand extends BaseCommand
{
    protected $group       = 'VendorMachine';
    protected $name        = 'vendor_machine:interactive';
    protected $description = 'Vendor Machine simple interactive shell';

    public function __construct(LoggerInterface $logger, Commands $commands)
    {
        parent::__construct($logger, $commands);
    }

    public function run(array $params)
    {
        system('stty -icanon'); // raw mode
        register_shutdown_function(fn() => system('stty sane'));

        /** @var VendorMachineUseCase $useCase */
        $useCase = service('VendorMachineUseCase');

        while (true) {
            CLI::write("\nVendor Machine Shell (type 'exit' to quit)", 'green');
            $input = CLI::prompt('>');

            if (trim($input) === 'exit') break;

            try {
                $result = $useCase->execute([$input]);
                CLI::write("✔ $result", 'yellow');
            } catch (InvalidVendorMachineInputException $e) {
                $this->logger->error($e->getMessage(), ['input' => $input]);
                CLI::write("✖ ERR_INPUT", 'red');
            } catch (\Throwable $e) {
                $this->logger->error($e->getMessage());
                CLI::write("✖ ERR_UNKNOWN", 'red');
            }
        }
    }
}