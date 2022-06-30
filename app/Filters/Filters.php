<?php

namespace App\Filters;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class Filters
{
    protected Request $request;
    protected Builder $builder;
    protected array $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    public function getFilters(): array
    {
        return array_filter($this->request->only($this->filters));
    }
}
