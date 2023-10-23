<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\RegisterForm;
use App\Models\SkillCompetence;
use App\Models\Address;
use App\Models\ParentGuardian;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\Home\UserDataRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserDataController extends Controller
{
    private $title_index;
    private $path_render;
    private $route_name;
    private $success_edit;

	public function __construct()
	{
		$this->path_render = "Home/UserData/";
		$this->title_index = "Formulir Pendaftaran";
		$this->route_name = "userdata.";
        $this->success_edit = Lang::get('messages.success_update', ['attribute' => $this->title_index]);
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();
        $register = RegisterForm::where('user_id', $auth->id)->first();
        $register->load(['user', 'admission']);
        $address = Address::where('register_form_id', $register->id)->first();
        $parentguardian_father = ParentGuardian::where('register_form_id', $register->id)->where('data_type', 'ayah')->first();
        $parentguardian_mother = ParentGuardian::where('register_form_id', $register->id)->where('data_type', 'ibu')->first();
        $parentguardian = ParentGuardian::where('register_form_id', $register->id)->where('data_type', 'wali')->first();
        $competence = SkillCompetence::paginateData('all');

        return Inertia::render($this->path_render . 'Create', [
            'register_model' => $register,
            'address_model' => $address,
            'father_model' => $parentguardian_father,
            'mother_model' => $parentguardian_mother,
            'guardian_model' => $parentguardian,
            'attr' => [
                'route_url' => route("{$this->route_name}store"),
                'title_profile' => 'Data Diri',
                'title_profile_desc' => 'Lengkapi data diri pendaftar',
                'title_address' => 'Data Alamat',
                'title_address_desc' => 'Lengkapi data alamat pendaftar',
                'title_father' => 'Data Ayah',
                'title_father_desc' => 'Lengkapi data ayah pendaftar',
                'title_mother' => 'Data Ibu',
                'title_mother_desc' => 'Lengkapi data ibu pendaftar',
                'title_guardian' => 'Data Wali',
                'title_guardian_desc' => 'Lengkapi data wali pendaftar',
                'competences' => generalSelectFormat($competence['data']),
                'residences' => generalResidence(),
                'transportations' => generalTransportation(),
                'distances' => generalDistance(),
                'traveling_times' => generalTravelingTime(),
                'parentguardianstatus' => generalParentGuardianStatus(),
                'educations' => generalEducation(),
                'works' => generalWork(),
                'incomes' => generalIncome(),
            ]
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserDataRequest $request)
    {
        $data = $request->validated();
        $auth = Auth::user();
        $register = RegisterForm::where('user_id', $auth->id)->first();
        $data['register_form_id'] = $register->id;
        if($data['type'] == 'register') {
            if($register->updateWebApp($request)) {
                return redirect()->route($this->route_name . 'create')->with('success', $this->success_edit);
            }
        } else if($data['type'] == 'addresses') {
            if(Address::createWebApp($data)) {
                return redirect()->route($this->route_name . 'create')->with('success', $this->success_edit);
            }
        } else if($data['type'] == 'father' || $data['type'] == 'mother' || $data['type'] == 'guardian') {
            $data['data_type'] = 'wali';
            if($data['type'] == 'father') {
                $data['data_type'] = 'ayah';
            } else if($data['type'] == 'mother') {
                $data['data_type'] = 'ibu';
            }
            if(ParentGuardian::createWebApp($data)) {
                return redirect()->route($this->route_name . 'create')->with('success', $this->success_edit);
            }
        }
    }
}
