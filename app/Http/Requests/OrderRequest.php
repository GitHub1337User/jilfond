<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cart' => 'required|array',
            'cart.*.id' => 'required|integer|exists:products,id',
            'cart.*.name' => 'required|string|max:255',
            'cart.*.quantity' => 'required|integer|min:1',
            // 'cart.*.price' => 'required|numeric|min:0',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         '*.id.required' => 'ID товара обязательно.',
    //         '*.id.exists' => 'Товар с таким ID не существует.',
    //         '*.name.required' => 'Название товара обязательно.',
    //         '*.quantity.required' => 'Количество товара обязательно.',
    //         '*.quantity.min' => 'Количество товара должно быть не менее 1.',
    //         '*.price.required' => 'Цена товара обязательна.',
    //         '*.price.min' => 'Цена товара должна быть не менее 0.',
    //     ];
    // }
}
