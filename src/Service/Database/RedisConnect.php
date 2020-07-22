<?php

declare(strict_types=1);

namespace App\Service\Database;

use Predis\Autoloader;
use Predis\Client;

class RedisConnect extends DBConnection
{
    public function connection(): Client
    {
        $settingsMySqli =  require_once __DIR__ . '/../../../config/database.php';

        Autoloader::register();

        return new Client([
            'scheme' => $settingsMySqli['redis']['connection']['scheme'],
            'host'   => $settingsMySqli['redis']['connection']['host'],
            'port'   => $settingsMySqli['redis']['connection']['port'],
        ]);
    }
}