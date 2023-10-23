<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFileRequest extends FormRequest
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
            'type' => [
                'required',
                'in:photo,kk,ijazah,akta_kelahiran,kip',
            ],
            'file_photo' => [
                'required',
                'mimes:jpg,jpeg,png',
                'max:' . (5 * 1024),
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
            'file_photo' => 'File Gambar',
        ];

        return $attributes;
    }
}
