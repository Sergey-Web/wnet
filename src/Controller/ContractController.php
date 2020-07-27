<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\Request;
use App\Response\Response;
use App\Service\SearchContract;
use App\Validation\Validation;

class ContractController
{
    private SearchContract $contractService;

    public function __construct()
    {
        $this->contractService = new SearchContract();
    }

    public function getCommunication(Request $request): string
    {
        $errors = (new Validation('contractSearch'))->check($request->toArray());

        if (!empty($errors)) {
            return (new Response($errors, 400))->json();
        }

        $contract = json_decode($this->contractService->search($request->toObject()), true);

        if (empty($contract)) {
            return (new Response(['error' => 'Contract not found'], 400))->json();
        }

        return (new Response($contract))->json();
    }

    public function search(Request $request): void
    {
        (new Response(['test' => 'ContractSearch']))->view('contract/search.php');
    }
}