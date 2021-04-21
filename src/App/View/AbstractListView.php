<?php

namespace Fira\App\View\Location;

use Fira\Domain\Utility\Pager;
use Fira\Domain\Utility\Sort;
use Slim\Psr7\Request;

abstract class AbstractListView
{
    protected Pager $pager;
    protected Sort $sort;
    protected array $userInput;

    public function __construct(Request $request)
    {
        $this->userInput = json_decode($request->getBody()->getContents(), true);
    }

    public function render(): array
    {
        $this->preparePager();
        return [
            'pager' => [
                'current_page' => $this->pager->getCurrentPage(),
                'page_size' => $this->pager->getPageSize(),
                'total_rows' => $this->pager->getTotalRows(),
                'total_pages' => $this->pager->getTotalPages(),
            ],
            'sort' => [
                'sort_col' => $this->getSortCol(),
                'sort_order' => $this->getSortOrder(),
            ],
            'list' => $this->getListItems($this->userInput['search'] ?? [])
        ];
    }

    abstract protected function getListItems(array $searchParams): array;

    public function preparePager(): Pager
    {
        $this->pager = new Pager($this->input['pageNumber'] ?? 1, $this->input['pageSize'] ?? 50);
        return $this->pager;
    }

    public function getSortCol(): string
    {
        return $this->userInput['sortCol'] ?? $this->getDefaultSortCol();
    }

    public function getSortOrder(): string
    {
        return $this->userInput['sortOrder'] ?? $this->getDefaultSortOrder();
    }

    protected function getDefaultSortCol(): string
    {
        return 'id';
    }

    protected function getDefaultSortOrder(): string
    {
        return 'asc';
    }
}