<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('product'));
    }

    public function rules(): array
    {
        return [
            'title' => ['string', 'max:40'],
            'amount' => ['numeric', 'between:0,100000.99'],
            'group_id' => ['required', 'exists:groups,id']
        ];
    }
}
