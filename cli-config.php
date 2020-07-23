<?php

declare(strict_types=1);

use App\Service\Database\DB;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Helper\HelperSet;

$entityManager = (new DB('doctrine'))->connection();

return new HelperSet([
    'em' => new EntityManagerHelper($entityManager),
    'db' => new ConnectionHelper($entityManager->getConnection()),
]);