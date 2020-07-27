<?php

declare(strict_types=1);

namespace App\Response;

class Response implements ResponseInterface
{
    public array $data;

    public function __construct(array $data, int $code = 200)
    {
        http_response_code($code);
        $this->data = $data;
    }

    public function json(): string
    {
        return json_encode($this->data);
    }

    public function view(string $template): void
    {
        $template = __DIR__ . '/../../template/'.$template;
        extract($this->data);
        require_once __DIR__ . '/../../template/index.php';
    }
}