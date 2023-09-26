<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoterRequest extends FormRequest
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
     * Get the validation rules that apply to the request.s
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'token' => [
                'required:5',
                'min:5',
                'max:100',
            ],
        ];

        if ($this->getMethod() == 'PUT') {
           
        }

        return $rules;
    }

    /**
    * Get custom attributes for validator errors.
    *
    * @return array
    */
    public function attributes()
    {
        $attributes = [
            'token' => 'Token',
        ];

        return $attributes;
    }
}
