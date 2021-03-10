<?php

namespace Fira\App\Controller;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class IndexController extends BaseController
{
    public function indexAction(Request $request, Response $response): Response
    {
        return $this->jsonResponse(['data' => 'Hello World!'], $response);
    }

    public function docAction(Request $request, Response $response): Response
    {
        return $this->jsonResponse([
            'data' => [
                'title' => 'Documents'
            ]
        ], $response);
    }
}
