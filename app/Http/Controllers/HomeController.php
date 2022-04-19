<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
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
        switch (auth()->user()->type) {
            case UserType::TEACHER_ADMIN:
                $classrooms = Classroom::all();
                break;
            case UserType::TEACHER:
                $classrooms = Classroom::where('user_id', auth()->user()->id)->get();
                break;
            default:
                $classrooms = User::ClassroomsStudents(auth()->user()->id);
                break;
        }

        return view($this->bladePath, compact('classrooms'));
    }
}
