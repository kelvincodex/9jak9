<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'productName'=>['required', 'string'],
            'productSellingPrice'=>['required', 'string'],
            'productOfferPrice'=>['required', 'string'],
            'productImage'=>['required', 'image'],
            'productDescription'=>['required','string'],
            'productDiscount'=>['required', 'string'],
            'productQuantity'=>['required', 'string'],
        ];
    }


}
