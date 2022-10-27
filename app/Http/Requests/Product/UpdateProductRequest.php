<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'productId'=>['required'],
            'productName'=>['required', 'string'],
            'productSellingPrice'=>['required', 'numeric'],
            'productOfferPrice'=>['required', 'numeric'],
            'productImage'=>['required'],
            'productDescription'=>['required','string'],
            'productDiscount'=>['required', 'numeric', 'max:100'],
            'productQuantity'=>['required', 'numeric'],
        ];
    }
}
