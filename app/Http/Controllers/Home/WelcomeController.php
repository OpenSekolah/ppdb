<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SkillCompetence;
use App\Models\Admission;
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
        $competence = SkillCompetence::paginateData('all');
        $adminssion = Admission::where('is_active', true)->get();
        $register = false;
        $register_data = [];
        if($adminssion) {
            if(count($adminssion) == 1) {
                $register = true;
                $register_data = $adminssion[0];
            }
        }
        
        return Inertia::render($this->path_render . 'Index', [
            'attr' => [
                'welcome' => 'welcome',
                'competence' => $competence['data'] ?? [],
                'competences' => generalSelectFormat($competence['data']),
                'register' => $register,
                'register_data' => $register_data,
            ]
        ]);
    }
}
