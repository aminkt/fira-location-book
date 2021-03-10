<?php

namespace Fira\App\Controller;

use Fira\Domain\UseCase\CreateLocationUC;
use Fira\Infrastructure\Database\InMemory\LocationRepository;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LocationController extends BaseController
{
    public function indexAction(Request $request, Response $response): Response
    {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Page not found!',
        ], 404, $response);
    }

    public function createAction(Request $request, Response $response): Response
    {
        $createUC = new CreateLocationUC(new LocationRepository());
        $createUC
            ->setName('Park Lale')
            ->setCategory('Park')
            ->setDescription('A good park.')
            ->setLatitude(32.3245)
            ->setLongitude(55.5678);

        $locationEntity = $createUC->execute();

        return $this->jsonResponse([
            'status' => 'ok',
            'data' => [
                'name' => $locationEntity->getName(),
                'category' => $locationEntity->getCategory(),
                'description' => $locationEntity->getDescription(),
                'latitude' => $locationEntity->getLatitude(),
                'longitude' => $locationEntity->getLongitude(),
            ]
        ], 200, $response);
    }
}
