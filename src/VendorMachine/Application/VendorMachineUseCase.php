<?php

namespace VendorMachine\Application;

use VendorMachine\Application\Services\VendorMachineParserService;
use VendorMachine\Domain\Exceptions\InvalidVendorMachineInputException;

class VendorMachineUseCase
{
    public function __construct(private readonly VendorMachineParserService $vendorMachineParserService) {
    }

    public function execute(array $params): string
    {
        if(empty($params)) {
            throw new InvalidVendorMachineInputException("No params given");
        }

        $input = array_values($params);
        if($input[0] === null || !$this->isValidInput($input[0])) {
            throw new InvalidVendorMachineInputException("Input looks incorrect");
        }

        $collection = $this->vendorMachineParserService->execute($input[0]);

        return "INSERT COIN";
    }

    private function isValidInput(string $input): bool
    {
        return preg_match('/^[A-Z0-9.,\s-]*$/', $input) === 1;
    }
}