<?php

declare(strict_types=1);

namespace App\Controller;

use mysqli;

class ContractController
{
    private mysqli $mysqli;

    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function getCommunication()
    {
        var_dump($this->mysqli);die;
    }


}