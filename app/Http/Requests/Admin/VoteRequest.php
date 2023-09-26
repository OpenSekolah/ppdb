<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoteRequest extends FormRequest
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
            'slug' => [
                'required',
                'max:191',
                Rule::unique('votes', 'slug')
            ],
            'desc' => [
                'nullable',
                'max:255',
            ],
            'number_of_choices' => [
                'required',
                'numeric',
                'min:1',
                'max:100',
            ],
            'is_active' => [
                'required',
                'in:0,1',
            ],
        ];

        if ($this->getMethod() == 'PUT') {
            $rules['slug'] = [
                'required',
                'max:191',
                Rule::unique('votes', 'slug')->ignore($this->vote),
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
            'name' => 'Nama Pemilihan',
            'slug' => 'Slug',
            'desc' => 'Keterangan',
            'number_of_choices' => 'Jumlah Pilihan',
            'is_active' => 'Status',
        ];

        return $attributes;
    }
}
