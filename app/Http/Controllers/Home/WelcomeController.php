<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SkillCompetence;
use App\Models\Admission;
use Inertia\Inertia;
use Carbon\Carbon;

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
        $adminssion = Admission::where('is_active', true)->first();
        $register = false;
        $register_data = [];
        if($adminssion) {
            $start_date = Carbon::parse($adminssion->start_date);
            $end_date = Carbon::parse($adminssion->end_date);
            $now_date = Carbon::now();
            if($now_date->gte($start_date) && $now_date->lte($end_date)) {
                $register = true;
                $register_data = $adminssion;
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
