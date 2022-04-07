<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Discipline;
use App\Models\User;

class TeacherController extends Controller
{
    private string $bladePath = 'teachers.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::where('teacher', 1)->paginate(10);

        return view($this->bladePath, compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $disciplines = Discipline::all();

        return view('teachers.create', compact('disciplines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        $teacher = User::create($request->validated());

        $teacher->disciplines()->attach($request['discipline_id']);

        return $this->redirectStoreSuccess($this->bladePath);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = User::find($id);

        if (!$teacher) {
            return $this->redirectNotFound($this->bladePath);
        }

        $disciplines = Discipline::all();

        return view('teachers.edit', compact('teacher', 'disciplines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request, $id)
    {
        $teacher = User::find($id);

        if (!$teacher) {
            return $this->redirectNotFound($this->bladePath);
        }

        $teacher->update($request->validated());
        
        return $this->redirectUpdatedSuccess($this->bladePath);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
