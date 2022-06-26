<?php

namespace App\Models;

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
}
