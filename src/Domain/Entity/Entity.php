<?php

namespace Fira\Domain\Entity;

use DateTimeImmutable;
use http\Exception\InvalidArgumentException;

class Entity
{
    protected ?int $id = null;
    protected DateTimeImmutable $createdAt;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int   $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable   $createdAt
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        throw new InvalidArgumentException('You can not change created at for this entity (' . self::class . ')');
    }
}
