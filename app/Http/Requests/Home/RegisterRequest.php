<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
                'max:255',
            ],
            'email' => [
                'required',
                'max:191',
                'unique:users'
            ],
            'place_of_birth' => [
                'required',
                'max:200',
            ],
            'date_of_birth' => [
                'required',
                'date',
            ],
            'address' => [
                'required',
                'max:65535',
            ],
            'from_school' => [
                'required',
                'max:255',
            ],
            'competence_first' => [
                'required',
                Rule::exists('skill_competences', 'id'),
            ],
            'competence_second' => [
                'required',
                'different:competence_first',
                Rule::exists('skill_competences', 'id'),
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8',
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
            'name' => 'Nama Lengkap',
            'email' => 'NISN',
            'place_of_birth' => 'Tempat Lahir',
            'date_of_birth' => 'Tanggal Lahir',
            'address' => 'Alamat',
            'from_school' => 'Asal Sekolah',
            'competence_first' => 'Jurusan 1',
            'competence_second' => 'Jurusan 2',
            'password' => 'Kata Sandi',
            'password_confirmation' => 'Konfirmasi Sandi',
        ];

        return $attributes;
    }
}
