<?php

namespace App\Http\Requests;

use App\Enums\GroupType;
use BenSampo\Enum\Rules\EnumKey;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('group'));
    }

    public function rules(): array
    {
        return [
            'title' => ['string', 'max:40'],
            'type' => [new EnumKey(GroupType::class)]
        ];
    }
}
