<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Database\DB;
use mysqli;
use Predis\Client;
use stdClass;

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

    public function search(stdClass $data): ?string
    {
        $contract = $this->casheContactService->getContract($data->query, $data->type);
        $contract = null;
        if ($contract === null) {
            $method = static::TYPES[$data->type];
            $status = implode("','", $data->status);

            $contract = $this->$method($data->query, $status);

            if ($contract !== null) {
                $this->casheContactService->setContract($data->query, $contract);
                $contract = json_encode($contract);
            }
        }

        return $contract;
    }

    public function searchNumContract(string $num, string $status): ?array
    {
        $res = [];
        $query = $this->mysqli->query("
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
            WHERE cont.number = {$num} AND serv.status IN ('{$status}')"
        );

        foreach ($query as $i) {
            $res[] = $i;
        }

        return $res;
    }

    public function searchIdContract(string $idContract, string $status): ?array
    {
        $res = [];
        $query = $this->mysqli->query("
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
            WHERE cont.id = {$idContract} AND serv.status IN ('{$status}')"
        );

        foreach ($query as $i) {
            $res[] = $i;
        }

        return $res;
    }
}