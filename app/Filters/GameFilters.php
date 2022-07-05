<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class GameFilters extends Filters
{
    protected array $filters = ['group'];

    protected function group($value): Builder
    {
        return $this->builder->where('group_id', $value);
    }
}
