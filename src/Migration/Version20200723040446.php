<?php

declare(strict_types=1);

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200723040446 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("
            INSERT INTO wnet.customers (id, name, company) 
            VALUES 
                (null, 'Max', 'company_1'),
                (null, 'Ruslan', 'company_2'),
                (null, 'Sonya', 'company_3'),
                (null, 'Roman', 'company_1'),
                (null, 'Jenya', 'company_2'),
                (null, 'Zoya', 'company_3'),
                (null, 'Sergey', 'company_1'),
                (null, 'David', 'company_2'),
                (null, 'Yulya', 'company_3'),
                (null, 'Maya', 'company_1');
                
            INSERT INTO wnet.contracts (id, customer_id, number, date_sign, staff_number) 
            VALUES 
                (null, 1, '10001', '2020-07-01', 115),
                (null, 2, '10002', '2020-07-02', 331),
                (null, 3, '10003', '2020-07-03', 211),
                (null, 4, '10004', '2020-07-04', 16),
                (null, 5, '10005', '2020-07-05', 77),
                (null, 6, '10006', '2020-07-06', 998),
                (null, 7, '10007', '2020-07-07', 111),
                (null, 8, '10008', '2020-07-08', 10),
                (null, 9, '10009', '2020-07-09', 20),
                (null, 10, '10010', '2020-07-10', 11000);
                
            INSERT INTO wnet.services (id, contract_id, title_service, status) 
            VALUES
                (null, 1, 'service_1', 'work'),
                (null, 2, 'service_2', 'connecting'),
                (null, 3, 'service_3', 'disconnected'),
                (null, 4, 'service_4', 'work'),
                (null, 5, 'service_5', 'connecting'),
                (null, 6, 'service_6', 'disconnected'),
                (null, 7, 'service_7', 'work'),
                (null, 8, 'service_8', 'connecting'),
                (null, 9, 'service_9', 'disconnected'),
                (null, 10, 'service_10', 'work'),
                (null, 1, 'service_11', 'work'),
                (null, 2, 'service_22', 'connecting'),
                (null, 3, 'service_33', 'disconnected'),
                (null, 4, 'service_44', 'work'),
                (null, 5, 'service_55', 'connecting'),
                (null, 6, 'service_66', 'disconnected'),
                (null, 7, 'service_77', 'work'),
                (null, 8, 'service_88', 'connecting'),
                (null, 9, 'service_99', 'disconnected'),
                (null, 10, 'service_100', 'work'),
                (null, 1, 'service_11', 'work'),
                (null, 2, 'service_22', 'connecting'),
                (null, 3, 'service_33', 'disconnected'),
                (null, 4, 'service_44', 'work'),
                (null, 5, 'service_55', 'connecting'),
                (null, 6, 'service_66', 'disconnected'),
                (null, 7, 'service_77', 'work'),
                (null, 8, 'service_88', 'connecting'),
                (null, 9, 'service_99', 'disconnected'),
                (null, 10, 'service_1000', 'work');
        ");

    }

    public function down(Schema $schema) : void
    {
        $this->addSql("
            TRUNCATE TABLE services;
            TRUNCATE TABLE contracts;
            TRUNCATE TABLE customers;
        ");

    }
}
