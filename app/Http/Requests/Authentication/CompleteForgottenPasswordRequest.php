<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class CompleteForgottenPasswordRequest extends FormRequest
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
            'customerOtp'=>['required', 'max:255'],
            'customerEmail'=>['required', 'max:255'],
            'newCustomerPassword'=>['required', 'max:255', 'confirmed']
        ];
    }
}
