<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape([
        'code' => "string",
        'name' => "string",
        'price' => "string",
        'count' => "string",
        'description' => "string"
    ])] public function rules()
    {
        $rules = [
            'code' => 'required|min:3|max:25',
            'name' => 'required|min:5|max:255',
            'price' => 'required|numeric|min:2',
            'count' => 'required|numeric|min:0',
            'description' => 'required|min:20|max:500',
        ];

        if ($this->route()->named(patterns: 'products.store')) {
            $rules['code'] .= '|unique:products,code';
        }

        return $rules;
    }

    #[ArrayShape(['required' => "string", 'min' => "string", 'code.min' => "string"])] public function messages()
    {
        return [
            'required' => 'The ":attribute" field is required',
            'min' => 'The ":attribute" field must be at least :min characters',
            'code.min' => 'The "code" field must have no less then :min symbols',
        ];
    }
}
