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
            'productBrandId'=>['required'],
            'productSellingPrice'=>['required', 'string'],
            'productOfferPrice'=>['required', 'string'],
            'productImage'=>['required'],
            'productDescription'=>['required','string'],
            'productDiscount'=>['required', 'string'],
            'productQuantity'=>['required', 'string'],
            'productCategoryId'=>['required'],
        ];
    }


}
