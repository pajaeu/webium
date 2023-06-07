<?php

namespace App\Middleware;

use App\Core\Security\Authentication\Authenticator;
use Latte\Engine;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminAuthenticationMiddleware implements MiddlewareInterface
{

    public function __construct(
        private readonly Authenticator $authenticator,
        private readonly ResponseFactoryInterface $responseFactory,
        private readonly Engine $engine,
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
        if ($user = $this->authenticator->getUser()) {
            $this->engine->addFunction('user', fn() => $user);

            return $handler->handle($request->withAttribute('user', $user));
        }

        return $this->responseFactory->createResponse(302)->withHeader('Location', '/');
    }
}