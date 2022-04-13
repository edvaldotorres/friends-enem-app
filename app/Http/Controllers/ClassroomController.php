<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Discipline;
use App\Models\User;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    private string $bladePath = 'classrooms.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::all();

        return view($this->bladePath, compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = User::ListTeachers()->get();

        $students = User::ListStudents()->get();

        $disciplines = Discipline::Disciplines()->get();

        return view('classrooms.create', compact('teachers', 'students', 'disciplines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassroomRequest $request)
    {
        // dd($request);
        // $teste = Classroom::ValidateTeacherClassesNoOverlap($request->user_id, $request->start_timestamp, $request->end_timestamp)->get();
        // $teste = Classroom::ValidateTeacherClassesNoFourHoursDay($request->user_id);
        
        // $teste = Classroom::ValidateTeacherClassesNoTwoDiciplineDay($request->user_id, $request->start_timestamp);

        // dd($teste);

        $classroom = Classroom::create($request->validated());

        $classroom->students()->attach($request['student_id']);

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

        return view('classrooms.ajax-discipline', compact('teacherDisciplines'));
    }
}
