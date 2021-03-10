<?php

namespace Fira\Test\UseCase;

use Fira\Domain\Entity\LocationEntity;
use Fira\Domain\Repository\LocationRepository;
use Fira\Domain\UseCase\CreateLocationUC;
use Fira\Domain\UseCase\UpdateLocationUC;
use PHPUnit\Framework\TestCase;

final class UpdateLocationUCTest extends TestCase
{
    private LocationRepository $locationRepository;

    public function setUp(): void
    {
        $this->locationRepository = new \Fira\Infrastructure\Database\InMemory\LocationRepository();
    }

    public function testUpdateLocation(): void
    {
        $uc = new CreateLocationUC($this->locationRepository);
        $uc
            ->setName('Lamiz')
            ->setCategory('Cafe')
            ->setDescription('Best cafe in Tehran!')
            ->setLatitude(13.43567)
            ->setLongitude(15.2134);
        $locationEntity = $uc->execute();

        $uc = new UpdateLocationUC($this->locationRepository, $locationEntity);
        $uc->setName('Ba Honar');
        $locationEntity = $uc->execute();

        $this->assertNotEmpty($locationEntity);
        $this->assertEquals('Ba Honar', $locationEntity->getName());
        $this->assertEquals('Cafe', $locationEntity->getCategory());
        $this->assertEquals('Best cafe in Tehran!', $locationEntity->getDescription());
        $this->assertEquals(13.43567, $locationEntity->getLatitude());
        $this->assertEquals(15.2134, $locationEntity->getLongitude());

        /** @var LocationEntity $inRepositoryEntity */
        $inRepositoryEntity = $this->locationRepository->getById($locationEntity->getId());
        $this->assertEquals($inRepositoryEntity->getName(), $locationEntity->getName());
    }
}
