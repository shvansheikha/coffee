<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCardRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('card'));
    }

    public function rules(): array
    {
        return [
            'title' => ['string', 'max:40']
        ];
    }
}
