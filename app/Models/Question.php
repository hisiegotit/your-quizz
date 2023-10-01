<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function answers(){
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

    public function quiz(){
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    public function storeQuestion($data){
        return Question::create($data);
    }

    public function updateQuestion($id, $data){
        $question = Question::find($id);
        $question->question = $data['question'];
        // dd($data['question_id']);
        $question->quiz_id = $data['quiz_id'];
        $question->save();

        return $question;
    }
}
