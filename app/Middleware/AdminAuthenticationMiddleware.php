<?php

namespace App\Middleware;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Latte\Engine;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminAuthenticationMiddleware implements MiddlewareInterface
{

    public function __construct(
        private readonly Engine $engine,
        private readonly ResponseFactoryInterface $responseFactory,
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

            $this->engine->addFunction('user', fn() => $user);

            return $handler->handle($request->withAttribute('user', $user));
        }

        return $this->responseFactory->createResponse(302)->withHeader('Location', '/');
    }
}