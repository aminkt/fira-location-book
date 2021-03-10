<?php

namespace Fira\Infrastructure\Database\Sql\Mysql;

use Fira\Domain\Entity\Entity;
use Fira\Domain\Utility\Pager;
use Fira\Domain\Utility\Sort;

class LocationRepository implements \Fira\Domain\Repository\LocationRepository
{
    public function getByName(string $name, Pager $pager, Sort $sort): array
    {
        // TODO: Implement getByName() method.
    }

    public function getByCategory(string $category, Pager $pager, Sort $sort): array
    {
        // TODO: Implement getByCategory() method.
    }

    public function registerEntity(Entity $entity): void
    {
        // TODO: Implement registerEntity() method.
    }

    public function save(): void
    {
        // TODO: Implement save() method.
    }

    public function getById(int $id): Entity
    {
        // TODO: Implement getById() method.
    }

    public function getByIds(array $id): array
    {
        // TODO: Implement getByIds() method.
    }

    public function delete(int $id): void
    {
        // TODO: Implement delete() method.
    }

    public function getNextid(): int
    {
        // TODO: Implement getNextid() method.
    }
}
