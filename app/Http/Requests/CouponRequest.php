<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * If you need this request to work, change the return value from false to true.
     * Also, when in use replaces the standard Request class in the Controllers.
     *
     * @return bool - indicates whether this class is enabled or disabled
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * Checkbox field "type" can only be enabled with chosen field "currency_id".
     *
     * @return array<string, mixed>
     */
    #[ArrayShape([
        'code' => "string",
        'value' => "string",
        'currency_id' => "string"
    ])] public function rules(): array
    {
        return [
            'code' => 'required|min:6|max:8',
            'value' => 'required',
            'currency_id' => 'required_with:type'
        ];
    }
}
