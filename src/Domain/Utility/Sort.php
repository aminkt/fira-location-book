<?php

namespace Fira\Domain\Utility;

class Sort
{
    private string $sortItem;
    private int $sortType;

    public function __constructor(int $sortItem, int $sortType)
    {
        $this->sortItem = $sortItem;
        $this->sortType = $sortType;
    }
}