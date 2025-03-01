<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopItemRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stocks' => 'required|integer|min:0',
        ];
    }
}