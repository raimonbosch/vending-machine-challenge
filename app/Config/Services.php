<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use VendingMachine\Application\Services\VendingMachineParserService;
use VendingMachine\Application\Services\VendingMachineService;
use VendingMachine\Application\VendingMachineUseCase;
use VendingMachine\Domain\Services\CoinAllocationService;
use VendingMachine\Domain\Services\CoinRechargeService;
use VendingMachine\Domain\Services\ProductRechargeService;
use VendingMachine\Infrastructure\Repository\CoinArrayRepository;
use VendingMachine\Infrastructure\Repository\ProductArrayRepository;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    public static function vendingMachineUseCase(): VendingMachineUseCase
    {
        $coinRechargeService = new CoinRechargeService();
        $productRechargeService = new ProductRechargeService();
        $cashierRepository = new CoinArrayRepository(new CoinAllocationService());
        $cashierRepository->recharge($coinRechargeService->getRechargeCoins());
        $productRepository = new ProductArrayRepository();
        $productRepository->recharge($productRechargeService->getRechargeProducts());

        return new VendingMachineUseCase(
            new VendingMachineParserService(),
            new VendingMachineService(
                new CoinArrayRepository(new CoinAllocationService()),
                $cashierRepository,
                $productRepository
            )
        );
    }
}
