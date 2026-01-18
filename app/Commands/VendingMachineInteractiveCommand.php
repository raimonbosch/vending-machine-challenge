<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\CLI\Commands;
use Psr\Log\LoggerInterface;
use VendingMachine\Application\VendingMachineUseCase;
use VendingMachine\Domain\Exceptions\InvalidVendingMachineInputException;

class VendingMachineInteractiveCommand extends BaseCommand
{
    protected $group       = 'VendingMachine';
    protected $name        = 'vending_machine:interactive';
    protected $description = 'Vending Machine simple interactive shell';

    public function __construct(LoggerInterface $logger, Commands $commands)
    {
        parent::__construct($logger, $commands);
    }

    public function run(array $params)
    {
        system('stty -icanon'); // raw mode
        register_shutdown_function(fn() => system('stty sane'));

        /** @var VendingMachineUseCase $useCase */
        $useCase = service('VendingMachineUseCase');

        while (true) {
            CLI::write("\nVendor Machine Shell (type 'exit' to quit)", 'green');
            $input = CLI::prompt('>');

            if (trim($input) === 'exit') break;

            try {
                $result = $useCase->execute([$input]);
                CLI::write("✔ $result", 'yellow');
            } catch (InvalidVendingMachineInputException $e) {
                $this->logger->error($e->getMessage(), ['input' => $input]);
                CLI::write("✖ ERR_INPUT", 'red');
            } catch (\Throwable $e) {
                $this->logger->error($e->getMessage());
                CLI::write("✖ ERR_UNKNOWN", 'red');
            }
        }
    }
}