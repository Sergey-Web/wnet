<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\Request;
use App\Response\Response;
use App\Service\CacheService;
use App\Service\CashContactService;
use App\Service\SearchContract;
use App\Validation\Validation;
use Exception;

class ContractController
{
    private SearchContract $contractService;

    private CashContactService $cashContactService;

    public function __construct()
    {
        $this->contractService = new SearchContract();
    }

    public function getCommunication(Request $request): string
    {
        $errors = (new Validation('contractSearch'))->check($request->toArray());

        if (!empty($errors)) {
            http_response_code(400);

            return (new Response($errors))->json();
        }

        $contract = $this->contractService->search($request->toObject()->query, $request->toObject()->type);

        if ($contract === null) {
            http_response_code(400);

            return (new Response(['error' => 'Contract not found']))->json();
        }

        return (new Response(json_decode($contract, true)))->json();
    }
}