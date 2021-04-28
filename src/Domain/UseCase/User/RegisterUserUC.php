<?php

namespace Fira\Domain\UseCase\User;

use Fira\Domain\Entity\UserEntity;
use Fira\Domain\Repository\UserRepository;
use Fira\Domain\UseCase\UseCaseInterface;
use Webmozart\Assert\Assert;

class RegisterUserUC implements UseCaseInterface
{
    private UserEntity $entity;
    private UserRepository $repo;

    private ?string $name = null;
    private ?string $family = null;
    private ?string $email = null;
    private ?string $password = null;

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setFamily(?string $family): self
    {
        $this->family = $family;
        return $this;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function __construct(UserRepository $locationRepository)
    {
        $this->repo = $locationRepository;
    }

    public function validate(): void
    {
        Assert::notEmpty($this->name);
        Assert::notEmpty($this->family);
        Assert::notEmpty($this->email);
        Assert::notEmpty($this->password);
        Assert::string($this->name);
        Assert::string($this->family);
        Assert::email($this->email);
        Assert::string($this->password);
        Assert::minLength($this->name, 3);
        Assert::minLength($this->family, 3);
        Assert::minLength($this->password, 6);


        $entity = $this->repo->getByEmail($this->email);
        Assert::null($entity, 'This email is taking by another user.');
    }

    public function execute(): UserEntity
    {
        $this->validate();

        $newEntity = new UserEntity();
        $newEntity->setName($this->name);
        $newEntity->setFamily($this->family);
        $newEntity->setEmail($this->email);
        $newEntity->setPasswordHash(password_hash($this->password, PASSWORD_DEFAULT));

        $this->repo->registerEntity($newEntity);
        $this->repo->save();

        return $newEntity;
    }
}