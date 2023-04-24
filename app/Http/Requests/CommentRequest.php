<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
     * This method helps to check which method of the CommentController was used.
     * If the method was "store", we use the validation for the specific field.
     *
     * @return bool
     */
    protected function isCreateRequest(): bool
    {
        return $this->route()->getActionMethod() === 'store';
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
            'username' => 'required|min:2|max:50|regex:/^[a-zA-Zа-яА-Я0-9]+$/',
            'email' => 'required|email',
            'comment' => 'required|min:1|max:255',
            'password' => [
                Rule::requiredIf($this->isCreateRequest()),
                'min:8',
                'max:30',
            ],
        ];
    }
}
