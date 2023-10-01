<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function question(){
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function storeAnswer($data, $question){
        foreach ($data['options'] as $key => $option) {
            $is_correct = false;
            if ($key == $data['correct_answer']) {
                $is_correct = true;
            }

            $answer = Answer::create([
                'question_id' => $question,
                'answer' => $option,
                'is_correct' => $is_correct
            ]);

        }
    }

    public function updateAnswer($data, $question){
        $this->deleteAnswer($question);
        $this->storeAnswer($data, $question);
    }

    public function deleteAnswer($data){
        Answer::where('question_id', $data)->delete();
    }
}
