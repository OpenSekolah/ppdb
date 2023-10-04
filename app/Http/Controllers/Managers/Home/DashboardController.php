<?php

namespace App\Http\Controllers\Managers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    private $path_render;
	private $title_index;
	private $breadcrumb_index;

	public function __construct()
	{
		$this->path_render = "Managers/Dashboard/";
		$this->title_index = $this->title_index = Lang::get('app.title_dashboard');;

		$this->breadcrumb_index = [
			[
				'title' => $this->title_index,
				'url' => null,
				'active' => true
			]
		];
	}

	/**
     * Retrieve details of an expense receipt from storage.
     *
     * @param   \Crater\Models\Expense $expense
     * @return  \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {	
		return Inertia::render($this->path_render . 'Index',[
			'attr' => [
                'title' => $this->title_index,
			    'breadcrumb' => $this->breadcrumb_index,
            ]
		]);
	}
}
