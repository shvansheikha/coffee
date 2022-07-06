<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('game'));
    }

    public function rules(): array
    {
        return [
            'title' => ['string', 'max:40'],
            'amount' => ['numeric', 'between:0,100000'],
            'group_id' => ['required', 'exists:groups,id']
        ];
    }
}
