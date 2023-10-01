<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::get();
        return view('backend.exam.index', compact('quizzes'));
    }


    public function create()
    {
        return view('backend.exam.assign');
    }

    public function assign(Request $request)
    {
        $quiz = (new Quiz)->assignExam($request->all());
        return redirect()->back()->with('message', 'Exam assigned to user successfully!');
    }

    public function destroy(Request $request)
    {
        $userID = $request->get('user_id');
        $quizID = $request->get('quiz_id');
        $quiz = Quiz::find($quizID);
        $result = Result::where('quiz_id', $quizID)->where('user_id', $userID)->exists();
        if ($result) {
            return redirect()->back()->with('danger', 'This quiz is already submitted so you can not delete it.');
        } else {
            $quiz->users()->detach($userID);
            return redirect()->back()->with('message', 'Exam unassigned to user successfully!');
        }
    }

    public function start(Request $request, $id)
    {
        $authUser = auth()->user()->id;

        // Check if user has been assigned a quiz
        $userID = DB::table('quiz_user')->where('user_id', $authUser)->pluck('quiz_id')->toArray();
        if (!in_array($id, $userID)) {
            return redirect()->to('/home');
        }

        $wasCompleted = Result::where('user_id', $authUser)->whereIn('quiz_id', (new Quiz)->hasQuizAttempted())->pluck('quiz_id')->toArray();
        if (in_array($id, $wasCompleted)) {
            return redirect()->to('/home');
        }

        $quiz = Quiz::find($id);
        $times = Quiz::where('id', $id)->value('minutes');
        $quizQuestions = Question::where('quiz_id', $id)->with('answers')->get();
        $hasCompletedQuiz = Result::where(['user_id' => $authUser, 'quiz_id' => $id])->get();

        return view('quiz', compact('quiz', 'times', 'quizQuestions', 'hasCompletedQuiz'));
    }

    public function result(Request $request)
    {
        $answerID = $request->answerID;
        $questionID = $request->questionID;
        $quizID = $request->quizID;
        $auth = auth()->user()->id;

        return $userAnswer = Result::updateOrCreate(
            ['user_id' => $auth, 'quiz_id' => $quizID, 'question_id' => $questionID],
            ['answer_id' => $answerID]
        );
    }

    public function viewResult($userID, $quizID)
    {
        $results = Result::where('user_id', $userID)->where('quiz_id', $quizID)->get();

        return view('result', compact('results'));
    }

    public function userResult()
    {
        $quizzes = Quiz::get();
        return view('backend.result.index', compact('quizzes'));
    }

    public function viewUserResult($quizID, $userID)
    {
        $results = Result::where('user_id', $userID)->where('quiz_id', $quizID)->get();
        $totalQuestions = Question::where('quiz_id', $quizID)->count();
        $attemptQuestions = Result::where('quiz_id', $quizID)->where('user_id', $userID)->count();
        $quizzes = Quiz::where('id', $quizID)->get();

        $ans = [];
        foreach ($results as $answer) {
            array_push($ans, $answer->answer_id);
        }

        $userCorrect = Answer::whereIn('id', $ans)->where('is_correct', 1)->count();
        $userIncorrect = $totalQuestions - $userCorrect;
        if ($attemptQuestions > 0) {
            $percentage = ($userCorrect / $totalQuestions) * 100;
        } else {
            $percentage = 0;
        }

        return view('backend.result.show', compact('results', 'totalQuestions', 'attemptQuestions', 'userCorrect', 'userIncorrect', 'percentage', 'quizzes'));
    }
}
