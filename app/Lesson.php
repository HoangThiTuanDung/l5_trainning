<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'result'
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function lessonWords()
    {
        return $this->hasMany(LessonWord::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
