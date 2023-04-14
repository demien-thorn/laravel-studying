<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class AddCouponRequest extends FormRequest
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
     * We check field coupon whether it exists in table "coupon" with its field called "code" or not.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['coupon' => "string"])] public function rules(): array
    {
        return [
            'coupon' => 'required|min:3|max:15|exists:coupons,code'
        ];
    }

    /**
     * Contains an array of messages showing when field is validated.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['coupon' => "mixed"])] public function messages(): array
    {
        return [
            'coupon' => __(key: 'notes.coupon_not_exist'),
        ];
    }
}
