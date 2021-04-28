<?php

namespace Fira\App\Controller;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class BaseController
{
    public function jsonResponse(array $data, int $statusCode, Response $response): Response
    {
        $response = $response->withStatus($statusCode);
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($data));
        return $response;
    }

    public function getRequestInputAsArray(Request $request): array
    {
        return json_decode($request->getBody()->getContents(), true);
    }
}
