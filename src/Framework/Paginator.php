<?php

namespace Framework;

class Paginator
{
    const LIMIT = 3;

    private $model;
    private $currentPage;
    private $sortableField;
    private $direction;

    protected $offset = 0;
    protected $totalPages = 0;

    public function __construct($model, $currentPage, $sortableField, $direction)
    {
        $this->model         = $model;
        $this->currentPage   = $currentPage;
        $this->sortableField = $sortableField;
        $this->direction     = $direction;
    }

    public function sortableFieldLink($path, $name)
    {
        $uri = '';
        if (!$this->sortableField or $this->sortableField !== $name) {
            $uri = $path . '?sortableField=' . $name . '&direction=asc';
        }

        if ($this->sortableField === $name) {
            $uri = ('asc' === $this->direction)
                ? $path . '?sortableField=' . $name . '&direction=desc'
                : $path . '?sortableField=' . $name . '&direction=asc';
        }

        return $uri . '&page=' . $this->currentPage;
    }

    public function getItems()
    {
        $this->totalPages = ceil($this->model::total() / self::LIMIT);
        $this->offset = ($this->currentPage - 1)  * self::LIMIT;

        return $this->model::paginated(
            self::LIMIT,
            $this->offset,
            $this->sortableField,
            $this->direction
        );
    }

    public function getPrev()
    {
        return $this->currentPage - 1;
    }

    public function getNext()
    {
        return $this->currentPage + 1;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function getPreviousUri($path)
    {
        if ($this->currentPage <= 1) {
            return '#';
        }

        $params = $this->getSortableParams() + [
            'page' => $this->getPrev(),
        ];

        return $path . '?' . http_build_query($params);
    }

    public function getNextUri($path)
    {
        if ($this->currentPage >= $this->totalPages) {
            return '#';
        }

        $params = $this->getSortableParams() + [
            'page' => $this->getNext(),
        ];

        return $path . '?' . http_build_query($params);
    }

    public function getPageUri($path, $page)
    {
        $params = $this->getSortableParams() + [
            'page' => $page,
        ];

        return $path . '?' . http_build_query($params);
    }

    protected function getSortableParams()
    {
        $params = [];

        if ($this->sortableField) {
            $params['sortableField'] = $this->sortableField;
            $params['direction'] = $this->direction;
        }

        return $params;
    }
}
