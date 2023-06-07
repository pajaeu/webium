<?php

namespace App\Core\Http;

use App\Renderer\LatteRenderer;
use DI\Attribute\Inject;
use Psr\Http\Message\ResponseInterface as Response;

abstract class AbstractController
{

    /**
     * @var LatteRenderer
     */
    #[Inject]
    private LatteRenderer $renderer;

    public function render(
        Response $response,
        string   $template,
        array    $data = [],
    ): Response
    {
        return $this->renderer->render($response, $template, $data);
    }
}