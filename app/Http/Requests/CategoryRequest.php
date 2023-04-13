<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
        'description' => "string"
    ])] public function rules(): array
    {
        $rules = [
            'code' => 'required|min:3|max:15|unique:categories,code',
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:20',
        ];

        if ($this->route()->named(patterns: 'categories.update')) {
            $rules['code'] .= ','.$this->route()->parameter(name: 'category')->id;
        }

        return $rules;
    }

    #[ArrayShape([
        'required' => "string",
        'min' => "string",
        'max' => "string",
        'code.min' => "string"
    ])] public function messages(): array
    {
        return [
            'required' => 'The ":attribute" field is required',
            'min' => 'The ":attribute" field must be at least :min characters',
            'max' => 'The ":attribute" field must be no more then :max characters',
            'code.min' => 'The "code" field must have no less then :min symbols',
        ];
    }
}
