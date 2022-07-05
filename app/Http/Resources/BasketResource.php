<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BasketResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->id,
            'card_title' => $this->card->title,
            'total_price' => $this->total_price,
            'closed_at' => $this->closed_at,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
