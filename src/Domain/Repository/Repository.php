<?php

namespace Fira\Domain\Repository;

use Fira\Domain\Entity\Entity;

interface Repository
{
    public function registerEntity(Entity $entity): void;

    public function save(): void;

    public function getById(int $id): Entity;

    public function getByIds(array $id): array;

    public function delete(int $id): void;

    public function getNextid(): int;
}