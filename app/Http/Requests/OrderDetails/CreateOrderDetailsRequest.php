<?php

namespace App\Http\Requests\OrderDetails;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderDetailsRequest extends FormRequest
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
            'orderDetailsFirstName'=>['required', 'max:255', 'string'],
            'orderDetailsLastName'=>['required', 'max:255', 'string'],
            'orderDetailsEmail'=>['required', 'max:255', 'email'],
            'orderDetailsPhone'=>['required', 'max:255', 'string'],
            'orderDetailsAddress'=>['required', 'max:255', 'string'],
            'orderDetailsCompany'=>['required', 'max:255', 'string'],
            'orderDetailsNote'=>['required', 'string'],
        ];
    }
}
