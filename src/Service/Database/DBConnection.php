<?php

declare(strict_types=1);

namespace App\Service\Database;

abstract class DBConnection implements DBConnectionInterface
{
    protected static ?self $instances;

    protected function __construct() {}

    protected function __clone() {}

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instances)) {
            self::$instances = new static;
        }

        return self::$instances;
    }

    abstract public function connection();
}