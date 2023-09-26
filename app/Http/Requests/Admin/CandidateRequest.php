<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CandidateRequest extends FormRequest
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
            'name' => [
                'required',
                'max:150',
            ],
            'address' => [
                'nullable',
                'max:65535',
            ],
            'vision' => [
                'nullable',
                'max:65535',
            ],
            'mission' => [
                'nullable',
                'max:65535',
            ],
            'file_photo' => [
                'required',
                'file',
                'mimes:jpeg,png,jpg,gif',
                'max:' . (1024 * 10),
            ],
        ];

        if ($this->getMethod() == 'PUT') {
            $rules['file_photo'] = [
                'nullable',
                'file',
                'mimes:jpeg,png,jpg,gif',
                'max:' . (1024 * 10),
            ];
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
            'name' => 'Nama Kandidat',
            'address' => 'Alamat',
            'vision' => 'Visi',
            'mission' => 'Misi',
            'file_photo' => 'Foto',
        ];

        return $attributes;
    }
}
