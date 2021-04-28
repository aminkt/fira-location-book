<?php

namespace Fira\App\Controller;

use Fira\App\DependencyContainer;
use Fira\App\View\Location\LocationListView;
use Fira\Domain\UseCase\CreateLocationUC;
use InvalidArgumentException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LocationController extends BaseController
{
    public function indexAction(Request $request, Response $response): Response
    {
        $userEntity = DependencyContainer::getAuthenticatedUserEntity();
        return $this->jsonResponse([
            'status' => 'ok',
            'data' => (new LocationListView($request, DependencyContainer::getLocationRepository()))->render(),
        ], 200, $response);
    }

    public function createAction(Request $request, Response $response): Response
    {
        $input = json_decode($request->getBody()->getContents(), true);
        $createUC = new CreateLocationUC(DependencyContainer::getLocationRepository());
        $createUC
            ->setName($input['name'] ?? null)
            ->setCategory($input['category'] ?? null)
            ->setDescription( $input['description'] ?? null)
            ->setLatitude($input['latitude'] ?? null)
            ->setLongitude($input['longitude'] ?? null);


        try {
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
        } catch (InvalidArgumentException $exception) {
            return $this->jsonResponse([
                'status' => 'failed',
                'data' => $exception->getMessage(),
            ], 400, $response);
        }
    }
}
