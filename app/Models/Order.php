<?php

namespace App\Models;

use App\Filters\OrderFilters;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function basket(): BelongsTo
    {
        return $this->belongsTo(Basket::class);
    }

    public function orderable(): MorphTo
    {
        return $this->morphTo();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'orderable_id');
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'orderable_id');
    }

    public function scopeFilter($query, OrderFilters $filters): Builder
    {
        return $filters->apply($query);
    }

    public function scopeOfUser($query, $user)
    {
        return $query->whereUserId($user->id);
    }

    public function scopeOfBasket($query, $basket)
    {
        return $query->where('basket_id', $basket->id);
    }

    public function scopeOwnProduct($query)
    {
        return $query->where('orderable_type', get_class(new Product));
    }

    public function scopeOwnGame($query)
    {
        return $query->where('orderable_type', get_class(new Game));
    }

    public function getDiffAttribute(): ?string
    {
        if (!empty($this->stopped_at)) {
            $from = Carbon::parse($this->started_at);
            $to = Carbon::parse($this->stopped_at);
            $diff_date = $to->diff($from);
            $diff = "";
            if ($diff_date->h > 0) {
                $diff .= $diff_date->h . ":";
            }
            $diff .= $diff_date->i . ":" . $diff_date->s;
            return $diff;
        }

        return null;
    }
}
