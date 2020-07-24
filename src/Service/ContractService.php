<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Database\DB;
use Exception;
use mysqli;
use stdClass;

class ContractService
{
    private mysqli $mysqli;
    private $redis;

    public function __construct()
    {
        $this->mysqli = (new DB('mysqli'))->connection();
    }

    public function searchContract(string $search, string $type): ?stdClass
    {
        switch($type) {
            case 'number':
                $res = $this->searchNumContract($search) ?? $this->searchNumContract($search);
                break;
            case 'contract_id':
                $res = $this->searchIdContract((int) $search);
                break;
            default:
                throw new Exception('Wrong search type', 400);
        }

        return $res;
    }

    public function searchNumContract(string $num): ?stdClass
    {
        return $this->mysqli->query('
            SELECT 
                cont.id,
                cont.number,
                cont.date_sign,
                cont.staff_number,
                cust.name,
                cust.company,
                serv.title_service,
                serv.status
            FROM wnet.contracts AS cont
            JOIN wnet.customers AS cust ON cont.customer_id = cust.id
            JOIN wnet.services AS serv ON cont.id = serv.contract_id
            WHERE cont.number = ' . $num
        )
            ->fetch_object()
        ;
    }

    public function searchIdContract(int $idContract): ?stdClass
    {
        return $this->mysqli->query('
            SELECT 
                cont.id,
                cont.number,
                cont.date_sign,
                cont.staff_number,
                cust.name,
                cust.company,
                serv.title_service,
                serv.status
            FROM wnet.contracts AS cont
            JOIN wnet.customers AS cust ON cont.customer_id = cust.id
            JOIN wnet.services AS serv ON cont.id = serv.contract_id
            WHERE cont.id = ' . $idContract
        )
            ->fetch_object()
        ;
    }
}