<?php

declare(strict_types=1);

namespace App\Service;

interface SearchContractInterface
{
    function search(string $query, string $type);
}