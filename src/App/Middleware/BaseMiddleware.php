<?php


namespace Fira\App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class BaseMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        $this->handleBefore($request, $response);
        $response = $next($request, $response);
        $this->handleAfter($request, $response);

        return $response;
    }

    abstract protected function handleBefore(ServerRequestInterface $request, ResponseInterface $response): void;

    abstract protected function handleAfter(ServerRequestInterface $request, ResponseInterface $response): void;
}