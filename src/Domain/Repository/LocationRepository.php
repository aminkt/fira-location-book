<?php

namespace Fira\Domain\Repository;

use Fira\Domain\Utility\Pager;
use Fira\Domain\Utility\Sort;

interface LocationRepository extends Repository
{
    public function getByName(string $name, Pager $pager, Sort $sort): array;

    public function getByCategory(string $category, Pager $pager, Sort $sort): array;

    public function search(array $searchParams, Pager $pager, Sort $sort): array;
}
