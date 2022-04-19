<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class StudentController extends Controller
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

    private string $bladePath = 'admin.students.index';

    private string $routePath = 'students.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin');
        
        $students = User::ListStudents()->paginate(10);

        return view($this->bladePath, compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin');

        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        Gate::authorize('admin');

        User::create($request->validated());

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

        $student = User::find($id);

        if (!$student) {
            return $this->redirectNotFound($this->routePath);
        }

        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        Gate::authorize('admin');

        $student = User::find($id);

        if (!$student) {
            return $this->redirectNotFound($this->routePath);
        }

        $student->update($request->validated());

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
        
        $student = User::find($id);

        if (!$student) {
            return $this->redirectNotFound($this->routePath);
        }

        $student->delete();

        return $this->redirectRemovedSuccess($this->routePath);
    }
}
