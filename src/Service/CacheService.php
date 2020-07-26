<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Database\DB;
use Predis\Client;

class CacheService
{
    private Client $redis;

    public function __construct()
    {
        $this->redis = (new DB('redis'))->connection();
    }

    public function searchContract(string $search, string $type)
    {

        return null;
    }
}