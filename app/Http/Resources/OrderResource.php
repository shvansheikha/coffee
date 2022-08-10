<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'started_at' => !empty($this->started_at) ? Carbon::parse($this->started_at)->format('H:i:s') : null,
            'stopped_at' => !empty($this->stopped_at) ? Carbon::parse($this->stopped_at)->format('H:i:s') : null,
            'price' => $this->price,
            'diff' => $this->diff,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
