<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class SubscribtionRequest extends FormRequest
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
    #[ArrayShape(['email' => "string"])] public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }

    #[ArrayShape(['email' => "string"])] public function messages()
    {
        return [
            'email' => 'E-mail field must contain a specific e-mail address'
        ];
    }
}
