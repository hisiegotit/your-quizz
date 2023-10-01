<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->is_admin == 1) {
                return redirect('/');
        }

        $authUser = Auth::user()->id;
        $assignedQuiz = [];
        $users = DB::table('quiz_user')->where('user_id', $authUser)->get();
        foreach ($users as $user) {
            array_push($assignedQuiz, $user->quiz_id);
        }
        $quizzes = Quiz::whereIn('id', $assignedQuiz)->get();

        $isExamAssigned = DB::table('quiz_user')->where('user_id', $authUser)->exists();

        $wasCompleted = Result::where('user_id', $authUser)->whereIn('quiz_id', (new Quiz)->hasQuizAttempted())->pluck('quiz_id')->toArray();

        return view('home', compact('quizzes', 'isExamAssigned', 'wasCompleted'));
    }
}
