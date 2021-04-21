<?php

namespace Fira\Domain\Utility;

class Pager
{
    private int $pageNumber;
    private int $pageSize;

    public function __constructor(int $pageNumber, int $pageSize)
    {
        $this->pageNumber = $pageNumber;
        $this->pageSize = $pageSize;
    }

    public function getCurrentPage(): int
    {
        return $this->pageNumber;
    }

    public function incrementPage(): self
    {
        $this->pageNumber++;
        return $this;
    }

    public function setCurrentPage(int $pageNumber): self
    {
        $this->pageNumber = $pageNumber;
        return $this;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function getTotalRows(): int
    {

    }

    public function getTotalPages(): int
    {

    }
}