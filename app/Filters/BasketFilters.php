<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class BasketFilters extends Filters
{
    protected array $filters = ['date'];

    protected function date($value): Builder
    {
        return $this->builder->whereDate('closed_at', '=', $value);
    }
}
