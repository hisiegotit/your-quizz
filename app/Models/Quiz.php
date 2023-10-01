<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function questions(){
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'quiz_user');
    }

    public function assignExam($data){
        $quiz = Quiz::find($data['quiz_id']);
        $userID = $data['user_id'];
        return $quiz->users()->syncWithoutDetaching($userID);
    }

    public function hasQuizAttempted(){
        $attemptQuiz = [];
        $authUser = auth()->user()->id;
        $users = Result::where('user_id', $authUser)->get();
        foreach ($users as $user) {
            array_push($attemptQuiz, $user->quiz_id);
        }
        return $attemptQuiz;
    }
}
