<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisterForm;
use App\Models\SkillCompetence;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\Home\UserDataRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
        $competence = SkillCompetence::paginateData('all');

        return Inertia::render($this->path_render . 'Create', [
            'register_model' => $register,
            'attr' => [
                'route_url' => route("{$this->route_name}store"),
                'title_profile' => 'Data Diri',
                'title_profile_desc' => 'Lengkapi data diri pendaftar',
                'residences' => generalResidence(),
                'transportations' => generalTransportation(),
                'distances' => generalDistance(),
                'distances' => generalDistance(),
                'traveling_times' => generalTravelingTime(),
                'competences' => generalSelectFormat($competence['data']),
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
        if($data['type'] == 'register') {
            unset($data['type']);
            $auth = Auth::user();
            $register = RegisterForm::where('user_id', $auth->id)->first();
            if($register->updateWebApp($request)) {
                return redirect()->route($this->route_name . 'create')->with('success', $this->success_edit);
            }
        }
        // $data['nisn'] = $data['email'];
        // $data['date_of_birth'] = Carbon::parse($data['date_of_birth'])->translatedFormat('Y-m-d');
        
        // if($user = User::createWebApp($data)) {
        //     // register_form.show
        //     return redirect()->route($this->route_name . 'show', ['user' => $user->id])
        //         ->with('success', $this->success_add)
        //         ->with('register', ['id' => $user->id, 'password' => $data['password']]);
        // }
    }
}
