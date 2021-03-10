<?php

namespace Fira\Domain\UseCase;

use Fira\Domain\Entity\LocationEntity;
use Fira\Domain\Repository\LocationRepository;
use Webmozart\Assert\Assert;

class UpdateLocationUC extends SaveLocationUC
{
    private LocationEntity $locationEntity;

    public function __construct(LocationRepository $repository, LocationEntity $entity)
    {
        parent::__construct($repository);
        $this->locationEntity = $entity;
        $this->loadEntityData();
    }

    private function loadEntityData(): void
    {
        $this->name = $this->locationEntity->getName();
        $this->description = $this->locationEntity->getDescription();
        $this->category = $this->locationEntity->getCategory();
        $this->latitude = $this->locationEntity->getLatitude();
        $this->longitude = $this->locationEntity->getLongitude();
    }
}