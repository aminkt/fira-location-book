<?php

namespace Fira\Domain\UseCase\User;

use Fira\Domain\Entity\UserEntity;
use Fira\Domain\Repository\UserRepository;
use Fira\Domain\UseCase\UseCaseInterface;
use Firebase\JWT\JWT;
use Webmozart\Assert\Assert;

class GetAccessTokenByUserCredentialUC implements UseCaseInterface
{
    const JWT_KEY = 'lgcyEO^Rs$FfKrpKhy!bAa@jEYEPFK@!XrWOAas$@yfZJI9f!K';

    private UserRepository $userRepo;
    private ?UserEntity $userEntity;

    private ?string $email = null;
    private ?string $password = null;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function validate(): void
    {
        Assert::email($this->email);
        Assert::string($this->password);
        Assert::notNull($this->getUserEntity(), 'User not exist!');
        Assert::true($this->isValidPassword(), 'Your is password is wrong.');
    }

    private function getUserEntity(): ?UserEntity
    {
        if ($this->userEntity === null) {
            $this->userEntity = $this->userRepo->getByEmail($this->email);
        }

        return $this->userEntity;
    }

    private function isValidPassword(): bool
    {
        $userEntity = $this->getUserEntity();
        if ($userEntity === null) {
            return false;
        }

        return password_verify($this->password, $userEntity->getPasswordHash());
    }

    public function execute(): string
    {
        $this->validate();

        return JWT::encode([
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => time(),
            "nbf" => time() + (30 * 12 * 60 * 60),
            "data" => [
                'userId' => $this->getUserEntity()->getId()
            ]
        ], self::JWT_KEY);
    }

    /**
     * @param string|null   $email
     *
     * @return GetAccessTokenByUserCredentialUC
     */
    public function setEmail(?string $email): GetAccessTokenByUserCredentialUC
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string|null   $password
     *
     * @return GetAccessTokenByUserCredentialUC
     */
    public function setPassword(?string $password): GetAccessTokenByUserCredentialUC
    {
        $this->password = $password;
        return $this;
    }


}
