<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
            'open' => $this->open,
            'started_at' => !empty($this->started_at) ? Carbon::parse($this->started_at)->format('H:i:s') : null,
            'closed_at' => !empty($this->closed_at) ? Carbon::parse($this->closed_at)->format('H:i:s') : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
