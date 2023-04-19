<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * If you need this request to work, change the return value from false to true.
     * Also, when in use replaces the standard Request class in the Controllers.
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
        'username' => "string",
        'email' => "string",
        'password' => "string",
        'comment' => "string"
    ])] public function rules(): array
    {
        return [
            'username' => 'required|min:2|max:50|regex:/^[a-z0-9]+$/',
            'email' => 'required|email',
            'password' => 'required|min:8|max:30',
            'comment' => 'required|min:1|max:255',
        ];
    }
}
