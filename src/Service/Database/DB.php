<?php

declare(strict_types=1);

namespace App\Service\Database;

use Exception;

class DB implements DBConnectionInterface
{
    private array $typeDatabase = [
        'doctrine' => DoctrineConnect::class,
        'mysqli' => MySQLiConnect::class,
        'redis' => RedisConnect::class,
    ];

    private string $database;

    public function __construct(string $database)
    {
        if (array_key_exists($database, $this->typeDatabase) === false) {
            throw new Exception('The requested database was not found');
        }

        $this->database = $this->typeDatabase[$database];
    }

    public function connection()
    {
        return $this->database::getInstance()->connection();
    }
}