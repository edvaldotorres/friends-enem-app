<?php

namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\Discipline;
use App\Models\User;
use Illuminate\Http\Request;

class ClassScheduleController extends Controller
{
    private string $bladePath = 'class-schedules.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classSchedules = ClassSchedule::all();

        return view($this->bladePath, compact('classSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = User::orderBy('name', 'ASC')->get();

        $disciplines = Discipline::where('id', 0)->orderBy('name', 'ASC')->get();

        return view('class-schedules.create', compact('teachers', 'disciplines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    /**
     * Teacher loading disciplines ajax request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxLoadingDisciplines(Request $request)
    {
        $dataForm = $request->all('user_id');

        $teacher_id = $dataForm['user_id'];

        $teacherDisciplines = User::with('disciplines')->where('id', $teacher_id)->find($teacher_id);

        return view('class-schedules.ajax-discipline', compact('teacherDisciplines'));
    }
}
