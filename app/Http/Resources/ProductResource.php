<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'group_id' => $this->group_id,
            'title' => $this->title,
            'group' => $this->group->title,
            'amount' => round($this->amount, 2),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
