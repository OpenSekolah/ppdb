<?php

namespace App\Http\Requests\Managers\Ppdb;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdmissionRequest extends FormRequest
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
            'year' => [
                'required',
                'date_format:Y',
                Rule::unique('admissions')->where(function ($query) {
                    return $query->where('year', $this->year)->where('stage', $this->stage);
                })
            ],
            'stage' => [
                'required',
                'min:1',
                'max:10',
            ],
            'quota' => [
                'required',
                'min:1',
                'max:1000',
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date',
            ],
            'is_active' => [
                'required',
                'in:0,1',
            ],
        ];

        if ($this->getMethod() == 'PUT') {
            $rules['year'] = [
                'required',
                'date_format:Y',
                Rule::unique('admissions')->where(function ($query) {
                    return $query->where('year', $this->year)->where('stage', $this->stage);
                })->ignore($this->admission)
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
            'year' => 'Tahun',
            'stage' => 'Gelombang',
            'quota' => 'Kuota',
            'start_date' => 'Mulai Tanggal',
            'end_date' => 'Berakhir Tanggal',
        ];

        return $attributes;
    }
}
