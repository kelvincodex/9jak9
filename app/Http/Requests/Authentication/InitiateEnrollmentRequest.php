<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class InitiateEnrollmentRequest extends FormRequest
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
            'customerFirstName'=>['required', 'max:255'],
            'customerLastName'=>['required', 'max:255'],
            'customerPhoneNo'=>['required', 'max:255'],
            'customerEmail'=>['required', 'max:255', 'unique:customers'],
        ];
    }
}
