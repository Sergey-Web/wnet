<?php

declare(strict_types=1);

namespace Route;

use Exception;
use Route\Handlers\{ContractRoute, RouteInterface, Main};

class Router implements RouterInterface
{
    private string $method;

    private string $params;

    private string $requestUri;

    private RouteInterface $route;

    private array $routes = [
        '' => Main::class,
        'contracts' => ContractRoute::class,
    ];

    public function __construct(string $requestUri, string $method, string $params)
    {
        $this->requestUri = $requestUri;
        $this->method = $method;
        $this->params = $params;
        $this->routeSelection();
    }

    public function getRoute(): RouteInterface
    {
        return $this->route;
    }

    private function routeSelection(): void
    {
        $uri = explode('/', $this->requestUri);

        if (array_key_exists($uri[1], $this->routes) === false) {
            throw new Exception('Route Not Found', 404);
        }

        $this->route = new $this->routes[$uri[1]](
            $this->requestUri,
            $this->method,
            $this->params
        );
    }
}