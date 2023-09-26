<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vote;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    
    private $path_render;

	public function __construct()
	{
		$this->path_render = "Home/Welcome/";
	}

    public function __invoke(Request $request)
    {
        return Inertia::render($this->path_render . 'Index', [
            'attributes' => [
                'welcome' => 'welcome'
            ]
        ]);
    }
}
