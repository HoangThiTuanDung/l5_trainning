<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonWord extends Model
{
    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function wordAnswer()
    {
        return $this->belongsTo(WordAnswer::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
