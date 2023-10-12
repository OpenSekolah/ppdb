<?php

namespace App\Http\Controllers\Managers\Ppdb;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use App\Models\RegisterForm;
use App\Models\SkillCompetence;
use App\Http\Requests\Managers\Ppdb\PpdbDataRequest;
use Inertia\Inertia;

class PpdbDataController extends Controller
{
    private $path_render;
	private $route_name;
	private $title_index;
	private $title_create;
	private $title_edit;
	private $breadcrumb_index;
	private $breadcrumb_create;
	private $breadcrumb_edit;
	private $success_add;
	private $success_edit;
	private $success_delete;

	public function __construct()
	{
		$this->path_render = "Managers/Ppdb/PpdbData/";
		$this->route_name = "manager.ppdb.ppdbdatas.";
		$this->title_index = "Berkas Data PPDB";
		$this->title_create = "Tambah {$this->title_index}";
		$this->title_edit = "Ubah {$this->title_index}";
		$this->success_add = Lang::get('messages.success_add', ['attribute' => $this->title_index]);
		$this->success_edit = Lang::get('messages.success_update', ['attribute' => $this->title_index]);
		$this->success_delete = Lang::get('messages.message_delete', ['attribute' => $this->title_index]);

        $this->breadcrumb_index = [
			[
				'title' => $this->title_index,
				'url' => null,
				'active' => true
            ]
		];

        $this->breadcrumb_create = [
			[
				'title' => $this->title_index,
				'url' => route($this->route_name . 'index'),
				'active' => true
			],
			[
				'title' => $this->title_create,
				'url' => null,
				'active' => true
			]
		];

        $this->breadcrumb_edit = [
			[
				'title' => $this->title_index,
				'url' => route($this->route_name . 'index'),
				'active' => false
			],
			[
				'title' => $this->title_edit,
				'url' => null,
				'active' => true
			]
		];
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = abs((int) $request->query('per_page', 50));
        $page = abs((int) $request->query('page', 1));
        $key = $request->query('key', 'religion');
        $queries = ['search', 'page'];
		
        $models = RegisterForm::with(['user', 'admission'])
                ->applyFilters($request->only($queries))
                ->paginateData($limit)
                ->appends(request()->query());
        
        return Inertia::render($this->path_render . 'Index', [
            'models' => $models,
            'attr' => [
                'add_link' => route($this->route_name . 'create'),
                'route_name' => $this->route_name,
                'title' => $this->title_index,
                'search' => $request->query('search', null),
                'breadcrumb' => $this->breadcrumb_index,
                'filters' => $request->all($queries),
                'start' => $limit * ($page - 1),
                'key_search' => $key,
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PpdbDataRequest $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RegisterForm $ppdbdata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RegisterForm $ppdbdata)
    {
        $ppdbdata->load(['user', 'admission']);

        $competence = SkillCompetence::paginateData('all');
        return Inertia::render($this->path_render . 'Create', [
            'model' => $ppdbdata,
            'attr' => [
                'form_type' => 'PUT',
                'route_url' => route($this->route_name . 'update', $ppdbdata->id),
                'title' => $this->title_edit,
                'breadcrumb' => $this->breadcrumb_edit,
                'competences' => generalSelectFormat($competence['data']),
                'statuses' => generalRegisterStatus(),
            ]
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PpdbDataRequest $request, RegisterForm $ppdbdata)
    {
        $ppdbdata->updateWebApp($request);
        return redirect()->route($this->route_name . 'index')->with('success', $this->success_edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegisterForm $ppdbdata)
    {
        // if($ppdbdata->destroyWebapp()) {
        //     redirect()->route($this->route_name . 'index')->with('success', $this->success_delete);
        // }
    }
}
