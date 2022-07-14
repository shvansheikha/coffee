<?php

namespace App\Models;

use App\Filters\ProductFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function orders(): MorphMany
    {
        return $this->morphMany(Order::class, 'orderable');
    }

    public function scopeFilter($query, ProductFilters $filters): Builder
    {
        return $filters->apply($query);
    }

    public function scopeOfUser($query, $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeWithGroup($query)
    {
        return $query->with(['group' => function ($query) {
            return $query->withTrashed();
        }]);
    }
}
