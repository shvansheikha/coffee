<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderFilters extends Filters
{
    protected array $filters = ['basket', 'type'];

    protected function basket($value): Builder
    {
        return $this->builder->where('basket_id', $value);
    }

    protected function type($value): Builder
    {
        if ($value == "game") {
            return $this->builder->ownGame();
        } elseif ($value == "product") {
            return $this->builder->ownProduct();
        }

        return $this->builder;
    }
}
