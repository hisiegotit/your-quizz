<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::latest()->paginate(5);

        return view('backend.quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|min:3|max:255',
            'minutes' => 'required|integer',
        ]);

        Quiz::create([
            'name' => $request->name,
            'description' => $request->description,
            'minutes' => $request->minutes,
        ]);

        return redirect()->route('quiz.index')->with('message', 'Quiz created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $quizzes = Quiz::where('id', $id)->with('questions')->get();
        return view('backend.quiz.show', compact('quizzes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('backend.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'string',
            'description' => 'min:3|max:255',
            'minutes' => 'integer',
        ]);

        $quiz = Quiz::findOrFail($id);

        $quiz->update([
            'name' => $request->name,
            'description' => $request->description,
            'minutes' => $request->minutes,
        ]);

        return redirect()->route('quiz.index')->with('message', 'Quiz updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route('quiz.index')->with('message', 'Quiz deleted successfully!');
    }
}
