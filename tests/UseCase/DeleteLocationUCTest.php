<?php

namespace Fira\Test\UseCase;

use Fira\Domain\Entity\LocationEntity;
use Fira\Domain\Repository\LocationRepository;
use Fira\Domain\UseCase\CreateLocationUC;
use Fira\Domain\UseCase\DeleteLocationUC;
use Fira\Domain\UseCase\UpdateLocationUC;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class DeleteLocationUCTest extends TestCase
{
    private LocationRepository $locationRepository;

    public function setUp(): void
    {
        $this->locationRepository = new \Fira\Infrastructure\Database\InMemory\LocationRepository();
    }

    public function testDeleteLocation(): void
    {
        $this->expectException(RuntimeException::class);
        $uc = new CreateLocationUC($this->locationRepository);
        $uc
            ->setName('Lamiz')
            ->setCategory('Cafe')
            ->setDescription('Best cafe in Tehran!')
            ->setLatitude(13.43567)
            ->setLongitude(15.2134);
        $locationEntity = $uc->execute();

        $uc = new DeleteLocationUC($this->locationRepository, $locationEntity);
        $uc->execute();

        /** @var LocationEntity $inRepositoryEntity */
        $this->locationRepository->getById($locationEntity->getId());
    }
}
