<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisciplineRequest;
use App\Models\Discipline;
use Illuminate\Support\Facades\Gate;

class DisciplineController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private string $bladePath = 'admin.disciplines.index';

    private string $routePath = 'disciplines.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin');

        $disciplines = Discipline::paginate(10);

        return view($this->bladePath, compact('disciplines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin');
        
        return view('admin.disciplines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisciplineRequest $request)
    {
        Gate::authorize('admin');

        Discipline::create($request->validated());

        return $this->redirectStoreSuccess($this->routePath);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('admin');

        $discipline = Discipline::find($id);

        if (!$discipline) {
            return $this->redirectNotFound($this->routePath);
        }

        return view('admin.disciplines.edit', compact('discipline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DisciplineRequest $request, $id)
    {
        Gate::authorize('admin');

        $discipline = Discipline::find($id);

        if (!$discipline) {
            return $this->redirectNotFound($this->routePath);
        }

        $discipline->update($request->validated());

        return $this->redirectUpdatedSuccess($this->routePath);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin');
        
        $discipline = Discipline::find($id);

        if (!$discipline) {
            return $this->redirectNotFound($this->routePath);
        }

        $discipline->delete();

        return $this->redirectRemovedSuccess($this->routePath);
    }
}
