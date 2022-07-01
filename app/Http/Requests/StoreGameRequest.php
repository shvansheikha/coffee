<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:40'],
            'amount' => ['required', 'numeric', 'between:0,100000'],
            'group_id' => ['required', 'exists:groups,id']
        ];
    }
}
