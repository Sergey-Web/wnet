<?php

declare(strict_types=1);

namespace App\Validation;

use App\Validation\Handlers\{ContractSearch, ValidationHandlerInterface};
use Exception;

class Validation implements ValidationInterface
{
    public array $types = [
        'contractSearch' => ContractSearch::class,
    ];

    private ValidationHandlerInterface $handler;

    public function __construct(string $type)
    {
        if (array_key_exists($type, $this->types) === false) {
            throw new Exception('Invalid type of validation');
        }

        $this->handler = new $this->types[$type];
    }

    public function check(array $data): array
    {
        return $this->handler->valid($data);
    }
}