<?php

declare(strict_types=1);

namespace App\Service;

use Predis\Client;

class CashContactService
{
    private const CONTRACT_NUMBER = 'number';
    private const CONTRACT_ID = 'contract_id';

    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getContract(string $id, string $type): ?string
    {
        if ($type === static::CONTRACT_NUMBER) {
            $id = $this->client->get("$type:$id");
        }

        return $this->client->get(static::CONTRACT_ID . ':' . $id);
    }

    public function setContract(string $id, array $dataContract): void
    {
        $this->client->set(static::CONTRACT_ID.':'.$id, json_encode($dataContract));
        $this->client->set(static::CONTRACT_NUMBER.':'.$dataContract['number'], $id);
    }

    public function flushAll()
    {
        $this->client->flushall();
    }
}