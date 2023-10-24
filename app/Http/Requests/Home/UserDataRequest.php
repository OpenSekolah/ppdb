<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserDataRequest extends FormRequest
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
        $rules = [];
        
        if($this->request->get('type') == 'register') {
            $rules = [
                'type' => [
                    'required',
                    'in:register',
                ],
                'name' => [
                    'required',
                    'max:255',
                ],
                'place_of_birth' => [
                    'required',
                    'max:200',
                ],
                'date_of_birth' => [
                    'required',
                    'date',
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
            ];
    
            if ($this->getMethod() == 'PUT') {
               
            }
    
            return $rules;
        }

        if($this->request->get('type') == 'addresses') {
            $rules = [
                'type' => [
                    'required',
                    'in:addresses',
                ],
                'residence' => [
                    'required',
                    'max:255',
                    'in:' . generalExplodeValidation(generalResidence()),
                ],
                'address' => [
                    'required',
                    'max:65535',
                ],
                'rt' => [
                    'required',
                    'numeric',
                    'min:1',
                    'max:1000'
                ],
                'rw' => [
                    'required',
                    'numeric',
                    'min:1',
                    'max:1000'
                ],
                'village' => [
                    'required',
                    'max:255'
                ],
                'subdistrict' => [
                    'required',
                    'max:255'
                ],
                'province' => [
                    'required',
                    'max:255'
                ],
                'postal_code' => [
                    'required',
                    'max:50'
                ],
                'address_coordinates' => [
                    'nullable',
                    'max:255'
                ],
                'transportation' => [
                    'required',
                    'max:255',
                    'in:' . generalExplodeValidation(generalTransportation()),
                ],
                'distance' => [
                    'required',
                    'max:255',
                    'in:' . generalExplodeValidation(generalDistance()),
                ],
                'traveling_time' => [
                    'required',
                    'max:255',
                    'in:' . generalExplodeValidation(generalTravelingTime()),
                ],
            ];
    
            if ($this->getMethod() == 'PUT') {
                
            }
    
            return $rules;
        }

        $in_array = ['father', 'mother', 'guardian'];
        if(in_array($this->request->get('type'), $in_array)) {
            $rules = [
                'type' => [
                    'required',
                    'in:father,mother,guardian',
                ],
                'nik' => [
                    'required',
                    'max:150',
                ],
                'status' => [
                    'required',
                    'max:255',
                    'in:' . generalExplodeValidation(generalParentGuardianStatus()),
                ],
                'name' => [
                    'required',
                    'max:255',
                ],
                'place_of_birth' => [
                    'required',
                    'max:255',
                ],
                'date_of_birth' => [
                    'required',
                    'date',
                ],
                'education' => [
                    'required',
                    'max:255',
                    'in:' . generalExplodeValidation(generalEducation()),
                ],
                'work' => [
                    'required',
                    'max:255',
                    'in:' . generalExplodeValidation(generalWork()),
                ],
                'income' => [
                    'required',
                    'max:255',
                    'in:' . generalExplodeValidation(generalIncome()),
                ],
                'phone' => [
                    'nullable',
                    'max:100'
                ],
            ];

            return $rules;
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
            'place_of_birth' => 'Tempat Lahir',
            'date_of_birth' => 'Tanggal Lahir',
            'address' => 'Alamat',
            'from_school' => 'Asal Sekolah',
            'competence_first' => 'Jurusan 1',
            'competence_second' => 'Jurusan 2',

            'residence' => 'Status Tempat Tinggal',
            'address' => 'Alamat',
            'rt' => 'Rt',
            'rw' => 'Rw',
            'village' => 'Desa',
            'subdistrict' => 'Kecamatan',
            'province' => 'Provinsi',
            'postal_code' => 'Kode Pos',
            'address_coordinates' => 'Koordinat Alamat',
            'transportation' => 'Transportasi',
            'distance' => 'Jarak dari rumah ke sekolah',
            'traveling_time' => 'Waktu Tempuh',

            'status' => 'Status',
            'nik' => 'Nik',
            'name' => 'Nama',
            'place_of_birth' => 'Tempat Lahir',
            'date_of_birth' => 'Tanggal Lahir',
            'education' => 'Pendidikan',
            'work' => 'Pekerjaan',
            'income' => 'Penghasilan',
            'phone' => 'No. HP',
        ];

        return $attributes;
    }
}
