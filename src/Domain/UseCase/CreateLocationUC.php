<?php

namespace Fira\Domain\UseCase;

use Fira\Domain\Entity\LocationEntity;
use Fira\Domain\Repository\LocationRepository;

class CreateLocationUC implements UseCaseInterface
{
    private string $name;
    private string $description;
    private string $category;
    private float $latitude;
    private float $longitude;

    private LocationRepository $repository;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string   $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string   $description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string   $category
     */
    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @param string   $latitude
     */
    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @param string   $longitude
     */
    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }



    public function validate(): void
    {
        // TODO: Implement validate() method.
    }

    public function execute(): LocationEntity
    {
        $locationEntity = new LocationEntity();
        $locationEntity
            ->setName($this->name)
            ->setCategory($this->category)
            ->setDescription($this->description)
            ->setLongitude($this->longitude)
            ->setLatitude($this->latitude);

        $this->repository->registerEntity($locationEntity);
        $this->repository->save();

        return $locationEntity;
    }
}