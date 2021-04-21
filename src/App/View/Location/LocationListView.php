<?php

namespace Fira\App\View\Location;

use Fira\Domain\Repository\LocationRepository;
use Slim\Psr7\Request;
use Webmozart\Assert\Assert;

class LocationListView extends AbstractListView
{
    private LocationRepository $repo;

    public function __construct(Request $request, LocationRepository $repository)
    {
        parent::__construct($request);
        $this->repo = $repository;
    }

    protected function getListItems(array $searchParams): array
    {
        $this->validateSearchParams($searchParams);

        $entities = $this->repo->search($searchParams, $this->pager, $this->sort);

        $result = [];
        foreach ($entities as $entity) {
            $result[] = (new LocationObjectView($entity))->getData();
        }

        return $result;
    }

    private function validateSearchParams(array $searchParams): void
    {
        Assert::string($searchParams['name']);
    }
}