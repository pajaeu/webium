<?php

namespace App\Renderer;

use Latte\Engine;
use Psr\Http\Message\ResponseInterface as Response;

class LatteRenderer
{

    public function __construct(
        private readonly Engine $engine,
    )
    {
    }

    public function render(
        Response $response,
        string   $template,
        array    $data = [],
    ): Response
    {
        $string = $this->engine->renderToString($template, $data);
        $response->getBody()->write($string);

        return $response;
    }
}