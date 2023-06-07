<?php

namespace App\Middleware;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthenticationMiddleware implements MiddlewareInterface
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!empty($_SESSION['userId'])) {
            $user = $this->entityManager->getRepository(User::class)->find($_SESSION['userId']);

            $request->withAttribute('user', $user);
        }

        return $handler->handle($request);
    }
}