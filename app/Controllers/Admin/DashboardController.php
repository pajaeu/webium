<?php

namespace App\Controllers\Admin;

use App\Core\Http\AbstractController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DashboardController extends AbstractController
{

    public function index(Request $request, Response $response): Response
    {
        return $this->render($response, 'admin/dashboard/index.latte');
    }
}