<?php


namespace Fira\App\View\User;


use Fira\App\View\Location\AbstractObjectView;
use Fira\Domain\Entity\UserEntity;

class UserObjectView extends AbstractObjectView
{
    private UserEntity $userEntity;

    public function __construct(UserEntity $userEntity)
    {
        $this->userEntity = $userEntity;
    }

    public function getData(): array
    {
        return [
            'name' => $this->userEntity->getName(),
            'family' => $this->userEntity->getName(),
            'email' => $this->userEntity->getName()
        ];
    }
}