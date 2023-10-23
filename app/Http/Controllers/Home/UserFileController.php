<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\RegisterForm;
use App\Models\UserFile;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\Home\UserFileRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserFileController extends Controller
{
    private $title_index;
    private $path_render;
    private $route_name;
    private $success_edit;

	public function __construct()
	{
		$this->path_render = "Home/UserFile/";
		$this->title_index = "Upload Berkas";
		$this->route_name = "userfile.";
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

        $photo_model = UserFile::where('register_form_id', $register->id)->where('file_type', 'foto')->first();
        $kk_model = UserFile::where('register_form_id', $register->id)->where('file_type', 'kk')->first();
        $ijazah_model = UserFile::where('register_form_id', $register->id)->where('file_type', 'ijazah')->first();
        $akta_kelahiran_model = UserFile::where('register_form_id', $register->id)->where('file_type', 'akta_kelahiran')->first();
        $kip_model = UserFile::where('register_form_id', $register->id)->where('file_type', 'kip')->first();

        return Inertia::render($this->path_render . 'Create', [
            'attr' => [
                'photo_model' => $photo_model,
                'kk_model' => $kk_model,
                'ijazah_model' => $ijazah_model,
                'akta_kelahiran_model' => $akta_kelahiran_model,
                'kip_model' => $kip_model,
                'route_url' => route("{$this->route_name}store"),
                'title_photo' => 'Unggah Foto',
                'title_photo_desc' => 'Unggah Foto Anda',
                'title_kk' => 'Unggah Kartu Keluarga',
                'title_kk_desc' => 'Unggah Kartu Keluarga Anda',
                'title_ijazah' => 'Unggah Ijazah/SKL',
                'title_ijazah_desc' => 'Unggah Ijazah/SKL Anda',
                'title_akta_kelahiran' => 'Unggah Akta Kelahiran',
                'title_akta_kelahiran_desc' => 'Unggah Akta Kelahiran Anda',
                'title_kip' => 'Unggah KIP',
                'title_kip_kelahiran_desc' => 'Unggah KIP Anda',
            ]
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFileRequest $request)
    {
        $data = $request->validated();
        $auth = Auth::user();
        $register = RegisterForm::where('user_id', $auth->id)->first();
        $request->merge(['register_form_id' => $register->id]);
        if($data['type'] == 'photo') {
            $request->merge(['file_type' => 'foto']);
        } else if($data['type'] == 'kk') {
            $request->merge(['file_type' => 'kk']);
        } else if($data['type'] == 'ijazah') {
            $request->merge(['file_type' => 'ijazah']);
        } else if($data['type'] == 'akta_kelahiran') {
            $request->merge(['file_type' => 'akta_kelahiran']);
        } else if($data['type'] == 'kip') {
            $request->merge(['file_type' => 'kip']);
        }

        if(UserFile::createWebApp($request)) {
            return redirect()->route($this->route_name . 'create')->with('success', $this->success_edit);
        }
    }
}
