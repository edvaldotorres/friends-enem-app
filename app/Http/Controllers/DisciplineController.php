<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisciplineRequest;
use App\Models\Discipline;

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
        $discipline = Discipline::find($id);

        if (!$discipline) {
            return $this->redirectNotFound($this->routePath);
        }

        $discipline->delete();

        return $this->redirectRemovedSuccess($this->routePath);
    }
}
