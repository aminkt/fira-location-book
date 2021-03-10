<?php

namespace Fira\Domain\UseCase;

use Fira\Domain\Entity\LocationEntity;
use \Fira\Domain\Repository\LocationRepository;

class DeleteLocationUC implements UseCaseInterface
{
    private LocationEntity $entity;
    private LocationRepository $repo;

    public function __construct(LocationRepository $locationRepository, LocationEntity $locationEntity)
    {
        $this->entity = $locationEntity;
        $this->repo = $locationRepository;
    }

    public function validate(): void
    {
        // Nothing to do.
    }

    public function execute()
    {
        $this->repo->delete($this->entity->getId());
    }
}