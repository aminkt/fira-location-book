<?php


namespace Fira\Domain\UseCase;


use Fira\Domain\Entity\LocationEntity;
use Fira\Domain\Repository\LocationRepository;
use Webmozart\Assert\Assert;

abstract class SaveLocationUC implements UseCaseInterface
{
    protected ?string $name = null;
    protected ?string $description = null;
    protected ?string $category = null;
    protected ?float $latitude = null;
    protected ?float $longitude = null;

    protected LocationRepository $repository;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): LocationEntity
    {
        $this->validate();
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

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function validate(): void
    {
        Assert::notEmpty($this->name, 'Name should not be empty!');
        Assert::string($this->name, 'Name should be string!');
        Assert::notEmpty($this->category, 'Category should not be empty!');
        Assert::string($this->category, 'Category should be string!');
        Assert::notEmpty($this->latitude, 'Latitude should not be empty!');
        Assert::float($this->latitude, 'Latitude should be float!');
        Assert::notEmpty($this->longitude, 'Longitude should not be empty!');
        Assert::float($this->longitude, 'Longitude should be float!');
        Assert::nullOrString($this->description, 'Invalid value for description provided.');
    }
}