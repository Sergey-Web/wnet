<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Database\DB;
use mysqli;
use Predis\Client;

class SearchContract implements SearchContractInterface
{
    private mysqli $mysqli;

    private Client $redis;

    private CashContactService $casheContactService;

    public const TYPES = [
        'contract_id' => 'searchIdContract',
        'number' => 'searchNumContract',
    ];

    public function __construct()
    {
        $this->mysqli = (new DB('mysqli'))->connection();
        $this->redis = (new DB('redis'))->connection();
        $this->casheContactService = new CashContactService();
    }

    public function search(string $query, string $type): ?string
    {
        $contract = $this->casheContactService->getContract($query, $type);

        if ($contract === null) {
            $method = static::TYPES[$type];
            $contract = $this->$method($query, $type);

            if ($contract !== null) {
                $this->casheContactService->setContract($query, $contract);
                $contract = json_encode($contract);
            }
        }

        return $contract;
    }

    public function searchNumContract(string $num): ?array
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
            ->fetch_assoc()
        ;
    }

    public function searchIdContract(string $idContract): ?array
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
            ->fetch_assoc()
        ;
    }
}