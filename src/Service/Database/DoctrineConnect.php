<?php

declare(strict_types=1);

namespace App\Service\Database;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use Doctrine\Common\EventManager;

class DoctrineConnect implements DBConnectionInterface
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

    public function connection(): EntityManager
    {
        $settingsMySql =  require __DIR__ . '/../../../config/database.php';

        $config = Setup::createAnnotationMetadataConfiguration(
            $settingsMySql['doctrine']['metadata_dirs'],
            $settingsMySql['doctrine']['dev_mode'],
            $settingsMySql['doctrine']['proxy_dir'],
            $settingsMySql['doctrine']['cache_dir']
                ? new FilesystemCache($settingsMySql['doctrine']['cache_dir'])
                : new ArrayCache(),
            false
        );

        $config->setNamingStrategy(new UnderscoreNamingStrategy());

        $eventManager = new EventManager();

        return EntityManager::create(
            $settingsMySql['doctrine']['connection'],
            $config,
            $eventManager
        );
    }
}