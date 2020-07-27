<?php

declare(strict_types=1);

namespace App\Service;

use stdClass;

interface SearchContractInterface
{
    function search(stdClass $data);
}