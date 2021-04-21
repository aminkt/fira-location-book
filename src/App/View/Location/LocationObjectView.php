<?php

namespace Fira\App\View\Location;

use Fira\Domain\Entity\LocationEntity;

class LocationObjectView extends AbstractObjectView
{
    protected LocationEntity $locationEntity;

    public function __construct(LocationEntity $locationEntity)
    {
        $this->locationEntity = $locationEntity;
    }

    public function getData(): array
    {
        return [
            'id' => $this->locationEntity->getId(),
            'name' => $this->locationEntity->getName(),
            'category' => $this->locationEntity->getCategory(),
            'description' => $this->locationEntity->getDescription(),
            'latitude' => $this->locationEntity->getLatitude(),
            'longitude' => $this->locationEntity->getLongitude(),
            'created_at' => $this->locationEntity->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}