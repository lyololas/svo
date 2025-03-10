<?php

// app/Models/Question.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question_text',
        'image',
        'quiz_id',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}