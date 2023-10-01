<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::orderBy('created_at', 'desc')->with('quiz')->paginate(10);
        return view('backend.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validator($request);
        $question = (new Question)->storeQuestion($data);
        $answer = (new Answer)->storeAnswer($data, $question->id);
        return redirect()->route('question.index')->with('message', 'Question created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::findOrFail($id);
        $previousItem = Question::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextItem = Question::where('id', '>', $id)->orderBy('id')->first();
        return view('backend.question.show', compact('question', 'previousItem', 'nextItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::findOrFail($id);

        return view('backend.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $this->validator($request);
        $question = (new Question)->updateQuestion($id, $request);
        $answer = (new Answer)->updateAnswer($data, $question->id);
        return redirect()->route('question.show', $id)->with('message', 'Question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('question.index')->with('message', 'Question deleted successfully!');
    }

    public function validator($request){
        return $this->validate($request, [
            'quiz_id' => 'required',
            'question' => 'required',
            'options' => 'required',
            'options.*' => 'required',
            'correct_answer' => 'required',
        ]);
    }
}
