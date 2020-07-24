<?php

declare(strict_types=1);

namespace Route\Handlers;

use App\Controller\ContractController;
use App\Request\Request;
use App\Service\Database\DB;

class ContractRoute implements RouteInterface
{
    private Request $params;

    private string $url;

    private string $action;

    private string $method;

    private array $actions = [
        '' => ['POST' => 'getCommunication'],
    ];

    public function __construct(string $url, string $method, string $params)
    {
        $this->method = $method;
        $this->handleUrl($url);
        $this->selectionAction();
        $this->params = new Request($params);
    }

    public function getAction()
    {
        $action = $this->action;

        return (new ContractController())->$action($this->params);
    }

    private function handleUrl(string $url): void
    {
        $this->url = trim($url,'/');
    }

    private function selectionAction(): void
    {
        $url = explode('/', $this->url);
        unset($url[0]);

        if (count($url) === 0) {
            $action = '';
        } else {
            //ToDo: Some kind of route logic
        }

        if (empty($this->actions[$action][$this->method])) {
           throw new \Exception('Route Not Found', 404);
        }

        $this->action = $this->actions[$action][$this->method];
    }
}