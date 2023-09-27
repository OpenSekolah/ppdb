<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SkillCompetence;
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
        return Inertia::render($this->path_render . 'Index', [
            'attr' => [
                'welcome' => 'welcome',
                'competence' => $competence['data'] ?? [],
                'competences' => generalSelectFormat($competence['data']),
            ]
        ]);
    }
}
