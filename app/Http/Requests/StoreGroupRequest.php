<?php

namespace App\Http\Requests;

use App\Enums\GroupType;
use BenSampo\Enum\Rules\EnumKey;
use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:40'],
            'type' => ['required', new EnumKey(GroupType::class)],
        ];
    }
}
