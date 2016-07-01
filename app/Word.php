<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = [
        'content', 'category_id'
    ];

    public function wordAnswers()
    {
        return $this->hasMany(WordAnswer::class);
    }

    public function lessonWords()
    {
        return $this->hasMany(LessonWord::class);
    }
}
