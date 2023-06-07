<?php

namespace App\Controllers\Front;

use App\Core\Http\AbstractController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends AbstractController
{

    public function index(Request $request, Response $response): Response
    {
        return $this->render($response, 'front/home/index.latte');
    }
}