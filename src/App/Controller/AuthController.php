<?php

namespace Fira\App\Controller;

use Fira\App\DependencyContainer;
use Fira\App\View\User\UserObjectView;
use Fira\Domain\UseCase\User\GetAccessTokenByUserCredentialUC;
use Fira\Domain\UseCase\User\RegisterUserUC;
use InvalidArgumentException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AuthController extends BaseController
{
    public function registerAction(Request $request, Response $response): Response
    {
        $input = $this->getRequestInputAsArray($request);
        $uc = new RegisterUserUC(DependencyContainer::getUserRepository());
        $userEntity = $uc
            ->setName($input['name'] ?? null)
            ->setFamily($input['family'] ?? null)
            ->setEmail($input['email'] ?? null)
            ->setPassword($input['password'] ?? null)
            ->execute();

        return $this->jsonResponse((new UserObjectView($userEntity))->getData(), 200, $response);
    }

    public function getAccessTokenAction(Request $request, Response $response): Response
    {
        $input = $this->getRequestInputAsArray($request);
        $uc = new GetAccessTokenByUserCredentialUC(DependencyContainer::getUserRepository());
        $uc
            ->setEmail($input['email'] ?? null)
            ->setPassword($input['password'] ?? null);

        try {
            $accessToken = $uc->execute();

            return $this->jsonResponse([
                'token' => $accessToken
            ], 200, $response);
        } catch (InvalidArgumentException $exception) {
            // Handle error conditions.
        }
    }
}
