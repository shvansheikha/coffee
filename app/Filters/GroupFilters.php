<?php

namespace App\Filters;

use App\Enums\GroupType;
use Illuminate\Database\Eloquent\Builder;

class GroupFilters extends Filters
{
    protected array $filters = ['type'];

    protected function type($value): Builder
    {
        if ($enum = GroupType::fromKey(ucfirst($value))) {
            return $this->builder->where('type', $enum->value);
        }

        return $this->builder;
    }
}
