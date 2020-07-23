<?php

declare(strict_types=1);

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200723033838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '
            CREATE TABLE `customers`
            (
                `id`      INT                                          NOT NULL,
                `name`    VARCHAR(250)                                 NOT NULL,
                `company` ENUM (\'company_1\', \'company_2\', \'company_3\') NOT NULL,
                PRIMARY KEY (id)
            ) ENGINE = INNODB;
            
            CREATE TABLE `contracts`
            (
                `id`           INT                NOT NULL,
                `customer_id`  INT                NOT NULL,
                `number`       VARCHAR(100)       NOT NULL,
                `date_sign`    DATE               NOT NULL,
                `staff_number` MEDIUMINT UNSIGNED NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (customer_id)
                    REFERENCES customers (id)
                    ON DELETE CASCADE
            ) ENGINE = INNODB;
            
            CREATE TABLE `services`
            (
                `id`            INT                                         NOT NULL,
                `contract_id`   INT                                         NOT NULL,
                `title_service` VARCHAR(250)                                NOT NULL,
                `status`        ENUM (\'work\', \'connecting\', \'disconnected\') NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (contract_id)
                    REFERENCES contracts (id)
                    ON DELETE CASCADE
            ) ENGINE = INNODB;
        ';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE TABLE IF NOT EXISTS `customers`
            (
                `id`      INT                                          NOT NULL,
                `name`    VARCHAR(250)                                 NOT NULL,
                `company` ENUM (\'company_1\', \'company_2\', \'company_3\') NOT NULL,
                PRIMARY KEY (id)
            ) ENGINE = INNODB;
            
            CREATE TABLE IF NOT EXISTS `contracts`
            (
                `id`           INT                NOT NULL,
                `customer_id`  INT                NOT NULL,
                `number`       VARCHAR(100)       NOT NULL,
                `date_sign`    DATE               NOT NULL,
                `staff_number` MEDIUMINT UNSIGNED NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (customer_id)
                    REFERENCES customers (id)
                    ON DELETE CASCADE
            ) ENGINE = INNODB;
            
            CREATE TABLE IF NOT EXISTS `services`
            (
                `id`            INT                                         NOT NULL,
                `contract_id`   INT                                         NOT NULL,
                `title_service` VARCHAR(250)                                NOT NULL,
                `status`        ENUM (\'work\', \'connecting\', \'disconnected\') NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (contract_id)
                    REFERENCES contracts (id)
                    ON DELETE CASCADE
            ) ENGINE = INNODB;
        ');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('
            DROP TABLE IF EXISTS `services`;
            DROP TABLE IF EXISTS `contracts`;
            DROP TABLE IF EXISTS `customers`;
        ');
    }
}
