<?php

declare(strict_types=1);

namespace App\Validation\Handlers;

class ContractSearch implements ValidationHandlerInterface
{
    private ?string $query;

    private ?string $searchType;

    public  function valid(array $data): array
    {
        $this->query = $data['query'] ?? null;
        $this->searchType = $data['type'] ?? null;

        return $this->checkRequiredFields();
    }

    private function checkRequiredFields(): array
    {
        $errors = [];

        if ($this->query === null) {
            $errors[] = ['query' => 'Field query is not specified'];
        }

        if ($this->searchType === null) {
            $errors[] = ['type' => 'Field type search is not specified'];;
        }

        $searchType = (new ValueObject('searchType'))->check($this->searchType);

        if ($searchType !== null) {
            $errors[] = ['type' => $searchType];
        }

        return $errors;
    }
}