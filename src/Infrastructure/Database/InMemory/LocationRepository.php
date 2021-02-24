<?php

namespace Fira\Infrastructure\Database\InMemory;

use Fira\Domain\Entity\Entity;
use Fira\Domain\Entity\LocationEntity;
use Fira\Domain\Utility\Pager;
use Fira\Domain\Utility\Sort;
use RuntimeException;

class LocationRepository implements \Fira\Domain\Repository\LocationRepository
{
    /** @var LocationEntity[]  */
    private array $entities = [];

    public function getByName(string $name, Pager $pager, Sort $sort): array
    {
        throw new RuntimeException('Not implemented yet!');
    }

    public function getByCategory(string $category, Pager $pager, Sort $sort): array
    {
        throw new RuntimeException('Not implemented yet!');
    }

    public function registerEntity(Entity $entity): void
    {
        if (!$entity->getId()) {
            $entity->setId($this->getNextid());
        }

       $this->entities[$entity->getId()] = $entity;
    }

    public function save(): void
    {
        // nothing to do.
    }

    public function getById(int $id): Entity
    {
        foreach ($this->entities as $entity) {
            if ($entity->getId() === $id) {
                return $entity;
            }
        }

        throw new RuntimeException("Entity with id ${id} in " . self::class);
    }

    public function getByIds(array $ids): array
    {
        $result = [];
        foreach ($this->entities as $entity) {
            if (in_array($entity->getId(), $ids)) {
                $result[] = $entity;
            }
        }
        return $result;
    }

    public function delete(int $id): void
    {
        unset($this->entities[$id]);
    }

    public function getNextid(): int
    {
        $id = 0;
        foreach ($this->entities as $entity) {
            if ($entity->getId() > $id) {
                $id = $entity->getId();
            }
        }

        return ++$id;
    }
}
