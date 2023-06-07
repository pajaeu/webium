<?php

namespace App\Controllers\Admin;

use App\Core\Http\AbstractController;
use App\Core\Security\Authentication\Authenticator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController extends AbstractController
{

    public function __construct(
        private readonly Authenticator $authenticator
    )
    {
    }

    public function login(Request $request, Response $response): Response
    {
        if ($request->getMethod() === 'POST'){
            $data = $request->getParsedBody();

            if ($this->authenticator->login($data['email'], $data['password'])){
                return $response->withHeader('Location', '/admin')->withStatus(302);
            }
        }

        return $this->render($response, 'admin/auth/login.latte');
    }
}