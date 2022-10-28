<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
    public function rules()
    {
        return [
            'orderFullName'=>['required'],
            'orderAddress'=>['required'],
            'orderEmail'=>['required', 'email'],
            'orderItem.*.orderProductVariation'=>['required'],
            'orderItem.*.orderProductQuantity'=>['required'],
            'orderItem.*.orderProductPrice'=>['required'],
            'orderItem.*.orderProductId'=>['required'],
            'orderSubTotalPrice'=>['required'],
            'orderTotalPrice'=>['required'],
        ];
    }
}
