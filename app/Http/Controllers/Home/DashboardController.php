<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    private $path_render;

	public function __construct()
	{
		$this->path_render = "Home/Dashboard/";
	}

    public function __invoke(Request $request)
    {
        $auth = Auth::user();
        $user = User::with(['register_form'])->find($auth->id);
        return Inertia::render($this->path_render . 'Show', [
            'attr' => [
                'user' => $user,
                'register_pdf_url' => route('register.pdf', $auth->id),
            ]
        ]);
    }
}
