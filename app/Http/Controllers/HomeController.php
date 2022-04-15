<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;

class HomeController extends Controller
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

    private string $bladePath = 'home';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->type == 1) {

            $classrooms = Classroom::all();

            return view($this->bladePath, compact('classrooms'));
        }

        if (auth()->user()->type == 2) {

            $classrooms = Classroom::where('user_id', auth()->user()->id)->get();

            return view($this->bladePath, compact('classrooms'));
        }

        $classrooms = User::ClassroomsStudents(auth()->user()->id);

        return view($this->bladePath, compact('classrooms'));
    }
}
