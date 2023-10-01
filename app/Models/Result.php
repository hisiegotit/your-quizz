<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function question(){
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function answer(){
        return $this->belongsTo(Answer::class, 'answer_id', 'id');
    }
}
