<?php

declare(strict_types=1);

namespace App\Service\Database;

use mysqli;

class MySQLiConnect implements DBConnectionInterface
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

    public function connection(): mysqli
    {
        $settingsMySqli =  require __DIR__ . '/../../../config/database.php';

        return new mysqli(
            $settingsMySqli['mysqli']['connection']['host'],
            $settingsMySqli['mysqli']['connection']['user'],
            $settingsMySqli['mysqli']['connection']['password'],
            $settingsMySqli['mysqli']['connection']['dbname']
        );
    }
}