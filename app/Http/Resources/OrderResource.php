<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'orderable_title' => $this->orderable->title,
            'orderable_group_title' => $this->orderable->group->title,
            'number' => $this->number,
            'amount' => $this->amount,
            'started_at' => $this->started_at,
            'stopped_at' => $this->stopped_at,
            'price' => $this->price,
            'diff' => $this->diff
        ];
    }
}
