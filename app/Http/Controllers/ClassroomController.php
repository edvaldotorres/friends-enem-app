<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Discipline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClassroomController extends Controller
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

    private string $bladePath = 'classrooms.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = auth()->user()->type;

        if ($type == 1) {

            $classrooms = Classroom::all();

            return view($this->bladePath, compact('classrooms'));
        }

        if ($type == 2) {

            $classrooms = Classroom::where('user_id', auth()->user()->id)->get();

            return view($this->bladePath, compact('classrooms'));
        }

        if ($type == 3) {

            $classrooms = User::ClassroomsStudents(auth()->user()->id);

            return view($this->bladePath, compact('classrooms'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::authorize('teacher-admin')) {
        }

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
        if (!Gate::authorize('teacher-admin')) {
        }

        $validatedClassroom = $this->validatedClassroom($request->user_id, $request->start_timestamp, $request->end_timestamp);

        if ($validatedClassroom) {
            return redirect()->back();
        }

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
        if (!Gate::authorize('teacher-admin')) {
        }

        $classroom = Classroom::find($id);

        if (!$classroom) {
            return $this->redirectNotFound($this->bladePath);
        }

        $teachers = User::ListTeachers()->get();

        $students = User::ListStudents()->get();

        return view('classrooms.edit', compact('classroom', 'teachers', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassroomRequest $request, $id)
    {
        if (!Gate::authorize('teacher-admin')) {
        }

        $classroom = Classroom::find($id);

        if (!$classroom) {
            return $this->redirectNotFound($this->bladePath);
        }

        $classroom->update($request->validated());

        $classroom->students()->sync($request['student_id']);

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
        if (!Gate::authorize('teacher-admin')) {
        }

        $classroom = Classroom::find($id);

        if (!$classroom) {
            return $this->redirectNotFound($this->bladePath);
        }

        $classroom->delete();

        return $this->redirectRemovedSuccess($this->bladePath);
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
