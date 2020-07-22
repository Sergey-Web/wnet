<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');

return [
    'doctrine' => [
        'dev_mode' => false,
        'cache_dir' => __DIR__ . '/../var/cache/doctrine/cache',
        'proxy_dir' => __DIR__ . '/../var/cache/doctrine/proxy',
        'connection' => [
            'driver' => 'pdo_mysql',
            'host' => $_ENV['DB_MYSQL_HOST'],
            'user' => $_ENV['DB_MYSQL_USER'],
            'password' => $_ENV['DB_MYSQL_PASSWORD'],
            'dbname' => $_ENV['DB_MYSQL_NAME'],
        ],
        'subscribers' => [],
        'metadata_dirs' => [
            __DIR__ . '/../src/Entity'
        ],
    ],
    'mysqli' => [
        'connection' => [
            'host' => $_ENV['DB_MYSQL_HOST'],
            'user' => $_ENV['DB_MYSQL_USER'],
            'password' => $_ENV['DB_MYSQL_PASSWORD'],
            'dbname' => $_ENV['DB_MYSQL_NAME'],
        ],
    ],
    'redis' => [
        'connection' => [
            'scheme' => $_ENV['DB_REDIS_SCHEME'],
            'host'   => $_ENV['DB_REDIS_HOST'],
            'port'   => $_ENV['DB_REDIS_PORT'],
        ],
    ],
];