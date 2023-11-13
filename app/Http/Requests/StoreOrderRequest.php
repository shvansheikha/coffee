<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('basket'));
    }

    public function rules(): array
    {
        $data = ['type' => ['required', 'string']];

        switch ($this->get('type')) {
            case "game":
                $data = array_merge($data,
                    ['orderable' => [
                        'required',
                        Rule::exists('games', 'id')->where('user_id', auth()->id())
                    ]]);
                break;

            case "product":
                $data = array_merge($data,
                    ['orderable' => [
                        'required',
                        Rule::exists('products', 'id')->where('user_id', auth()->id())
                    ],
                        'number' => ['required', 'int', 'max:100']]);
                break;
        };

        return $data;
    }
}
