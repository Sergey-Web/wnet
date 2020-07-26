<?php

declare(strict_types=1);

namespace App\Validation\Handlers\Fields;

use App\Service\SearchContract;

class SearchType implements ValidationFieldInterface
{
    private const MESSAGE = 'Search type is not correct';

    public static function isValid($value): ?string
    {
        $error = null;

        if (array_key_exists($value, SearchContract::TYPES) === false) {
            $error = static::MESSAGE;
        }

        return $error;
    }
}