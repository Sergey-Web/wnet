<?php

declare(strict_types=1);

namespace App\Service\Database;

use mysqli;

class MySQLiConnect extends DBConnection
{
    public function connection(): mysqli
    {
        $settingsMySqli =  require_once __DIR__ . '/../../../config/database.php';

        return new mysqli(
            $settingsMySqli['mysqli']['connection']['host'],
            $settingsMySqli['mysqli']['connection']['user'],
            $settingsMySqli['mysqli']['connection']['password'],
            $settingsMySqli['mysqli']['connection']['dbname'],
        );
    }
}