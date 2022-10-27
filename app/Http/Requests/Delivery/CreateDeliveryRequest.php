<?php

namespace App\Http\Requests\Delivery;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeliveryRequest extends FormRequest
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
            'deliveryState'=>['required', 'max:255'],
            'deliveryStatus'=>['required', 'max:255'],
            'deliveryMinFee'=>['required'],
            'deliveryMaxFee'=>['required'],
            'deliveryDescription'=>['required'],
        ];
    }
}
