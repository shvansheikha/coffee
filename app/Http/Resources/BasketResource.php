<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BasketResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->id,
            'card_title' => $this->card->title,
            'products_price' => round($this->products_price, 2) ?? null,
            'games_price' => round($this->games_price, 2) ?? null,
            'total_price' => $this->total_price,
            'closed_at' => !empty($this->closed_at) ? Carbon::parse($this->closed_at)->format('H:i:s') : null,
            'created_at' => $this->created_at->format('H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
