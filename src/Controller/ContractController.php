<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\Request;
use App\Response\Response;
use App\Service\CacheService;
use App\Service\ContractService;

class ContractController
{
    private ContractService $contractService;

    private CacheService $cacheService;

    public function __construct()
    {
        $this->cacheService = new CacheService();
        $this->contractService = new ContractService();
    }

    public function getCommunication(Request $request): string
    {

        $contract = $this->cacheService->searchContract(
            $request->toObject()->search,
            $request->toObject()->type
        );

        if ($contract === null) {
            $contract = (array) $this->contractService->searchContract(
                $request->toObject()->search,
                $request->toObject()->type
            );
        }

        if (empty($contract)) {
            return (new Response(['error' => 'contract not found']))->json();
        }

        return (new Response($contract))->json();
    }
}