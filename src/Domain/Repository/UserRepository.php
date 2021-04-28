<?php

namespace Fira\Domain\Repository;

use Fira\Domain\Entity\UserEntity;
use Fira\Domain\Utility\Pager;
use Fira\Domain\Utility\Sort;

interface UserRepository extends Repository
{
    public function getByEmail(string $email): ?UserEntity;

    public function search(array $searchParams, Pager $pager, Sort $sort): array;
}
