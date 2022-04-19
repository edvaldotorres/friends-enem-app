<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
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

    private string $routePath = 'home';

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin');

        $teachers = User::ListTeachers()->get();

        $students = User::ListStudents()->get();

        $disciplines = Discipline::Disciplines()->get();

        return view('admin.classrooms.create', compact('teachers', 'students', 'disciplines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassroomRequest $request)
    {
        Gate::authorize('admin');

        $validatedClassroom = $this->validatedClassroom($request->user_id, $request->start_timestamp, $request->end_timestamp);

        if ($validatedClassroom) {
            return redirect()->back();
        }

        $classroom = Classroom::create($request->validated());

        $classroom->students()->attach($request['student_id']);

        return $this->redirectStoreSuccess($this->routePath);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        switch (auth()->user()->type) {
            case UserType::TEACHER_ADMIN:
                $classroom = Classroom::find($id);
                break;
            case UserType::TEACHER:
                $classroom = Classroom::where('user_id', auth()->user()->id)->find($id);
                break;
            default:
                $classroom = User::ClassroomsStudents(auth()->user()->id)->find($id);
                break;
        }

        if (!$classroom) {
            return $this->redirectNotFound($this->routePath);
        }

        $teachers = User::ListTeachers()->get();

        $students = User::ListStudents()->get();

        return view('admin.classrooms.show', compact('classroom', 'teachers', 'students'));
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

        $classroom = Classroom::find($id);

        if (!$classroom) {
            return $this->redirectNotFound($this->routePath);
        }

        $teachers = User::ListTeachers()->get();

        $students = User::ListStudents()->get();

        return view('admin.classrooms.edit', compact('classroom', 'teachers', 'students'));
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
        Gate::authorize('admin');

        $classroom = Classroom::find($id);

        if (!$classroom) {
            return $this->redirectNotFound($this->routePath);
        }

        $teacherNoTwoDiciplineDay = false;
        $teacherNoOverlap = false;
        $teacherNoFourHoursDay = false;
        $validatedDate = false;

        if ($classroom->discipline_id != $request->discipline_id) {
            $teacherNoTwoDiciplineDay = $this->teacherNoTwoDiciplineDay($request->user_id, $request->start_timestamp);
        }

        if ($classroom->startTimestampDate != $request->start_timestamp || $classroom->endTimestampDate != $request->end_timestamp) {

            $teacherNoOverlap = $this->teacherNoOverlap($request->user_id, $request->start_timestamp, $request->end_timestamp);

            $teacherNoFourHoursDay = $this->teacherNoFourHoursDay($request->user_id, $request->start_timestamp);

            $validatedDate = $this->validatedDate($request->start_timestamp, $request->end_timestamp);
        }

        if ($teacherNoTwoDiciplineDay || $teacherNoOverlap || $teacherNoFourHoursDay || $validatedDate) {
            return redirect()->back();
        }

        $classroom->update($request->validated());

        $classroom->students()->sync($request['student_id']);

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

        $classroom = Classroom::find($id);

        if (!$classroom) {
            return $this->redirectNotFound($this->routePath);
        }

        $classroom->delete();

        return $this->redirectRemovedSuccess($this->routePath);
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

        return view('admin.classrooms.ajax-discipline', compact('teacherDisciplines'));
    }
}
