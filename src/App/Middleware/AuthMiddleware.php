<?php

namespace Fira\App\Middleware;


use Exception;
use Fira\App\DependencyContainer;
use Fira\Domain\Entity\UserEntity;
use Fira\Domain\UseCase\User\GetAccessTokenByUserCredentialUC;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpForbiddenException;
use Webmozart\Assert\Assert;

class AuthMiddleware extends BaseMiddleware
{
    protected function handleBefore(ServerRequestInterface $request, ResponseInterface $response): void
    {
        $jwtToken = $request->getHeaderLine('Authorization');
        if (empty($jwtToken)) {
            throw new HttpForbiddenException($request,'UnAuthorized request!');
        }

        try {
            $tokenData = JWT::decode($jwtToken, GetAccessTokenByUserCredentialUC::JWT_KEY);
            $userId = $tokenData['data']['userId'] ?? null;
            Assert::notNull($userId);

            /** @var UserEntity $userEntity */
            $userEntity = DependencyContainer::getUserRepository()->getById($userId);
            DependencyContainer::setAuthenticatedUserEntity($userEntity);
        } catch (Exception $exception) {
            throw new HttpForbiddenException($request,'Invalid token provided!');
        }
    }

    protected function handleAfter(ServerRequestInterface $request, ResponseInterface $response): void
    {
        // Nothing to do
    }
}