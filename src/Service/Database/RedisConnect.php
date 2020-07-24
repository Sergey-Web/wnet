<?php

declare(strict_types=1);

namespace App\Service\Database;

use Predis\Autoloader;
use Predis\Client;

class RedisConnect implements DBConnectionInterface
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

    public function connection(): Client
    {
        $settings =  require __DIR__ . '/../../../config/database.php';

        Autoloader::register();

        return new Client([
            'scheme' => $settings['redis']['connection']['scheme'],
            'host'   => $settings['redis']['connection']['host'],
            'port'   => $settings['redis']['connection']['port'],
        ]);
    }
}