<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\Home\RegisterRequest;
use Carbon\Carbon;
use Inertia\Inertia;

class RegisterController extends Controller
{
    private $title_index;
    private $path_render;
    private $route_name;
    private $success_add;

	public function __construct()
	{
		$this->path_render = "Home/Register/";
		$this->title_index = "Pendaftaran";
		$this->route_name = "register_form.";
		$this->success_add = Lang::get('messages.success_add', ['attribute' => $this->title_index]);
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(session('register')) {
            $register = session('register');
            if($register['id'] == $user->id) {
                $user->load(['register_form']);
                return Inertia::render($this->path_render . 'Index', [
                    'attr' => [
                        'user' => $user,
                        'register' => $register,
                    ]
                ]);
            }
        }

        abort(404);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['nisn'] = $data['email'];
        $data['date_of_birth'] = Carbon::parse($data['date_of_birth'])->translatedFormat('Y-m-d');
        
        if($user = User::createWebApp($data)) {
            // register_form.show
            return redirect()->route($this->route_name . 'show', ['user' => $user->id])
                ->with('success', $this->success_add)
                ->with('register', ['id' => $user->id, 'password' => $data['password']]);
        }
    }
}
