<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class AddCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * If you need this request to work, change the return value from false to true.
     * Also when in use replaces the standard Request class in the Controllers.
     *
     * @return bool - indicates whether this class is enabled or disabled
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * We check field coupon whether it exests in table "coupon" with it's field called "code" or not.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['coupon' => "string"])] public function rules()
    {
        return [
            'coupon' => 'required|min:6|max:8|exists:coupons,code'
        ];
    }

    /**
     * Contains array of messages showing when field is validated.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['coupon' => "mixed"])] public function messages()
    {
        return [
            'coupon' => __(key: 'notes.coupon_not_exist'),
        ];
    }
}
