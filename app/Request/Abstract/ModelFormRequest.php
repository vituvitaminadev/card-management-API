<?php

namespace App\Request\Abstract;

use App\Request\BaseRequest;
use Hyperf\Database\Model\Builder;
use function Hyperf\Support\make;

abstract class ModelFormRequest extends BaseRequest
{
    protected Builder $builder;

    protected string $defaultSortColumn = 'id';

    protected array $availableSortColumns = [];

    abstract protected function model(): string;

    public function builder(): Builder
    {
        if (!isset($this->builder)) {
            $this->builder = make($this->model())::query();
        }

        return $this->builder;
    }

    public function applySort(): Builder
    {
        $sortKey = $this->input('sortBy', $this->defaultSortColumn);
        $sortDirection = $this->input('sortDirection', 'asc');

        if(!in_array($sortKey, $this->availableSortColumns, true)) {
            $sortKey = $this->defaultSortColumn;
        }

        return $this->builder()->orderBy($sortKey, $sortDirection);
    }
}