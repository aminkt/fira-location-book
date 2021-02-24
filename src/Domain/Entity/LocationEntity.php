<?php

namespace Fira\Domain\Entity;

class LocationEntity extends Entity
{
    protected int $id;
    protected string $name;
    protected float $latitude;
    protected float $longitude;
    protected string $category;
    protected ?string $description = null;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string   $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float   $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float   $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string   $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null   $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }


}