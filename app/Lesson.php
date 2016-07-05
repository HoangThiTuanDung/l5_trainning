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

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public static function getWord($lessonID, $nextWord = 0)
    {
        return self::with(['words' => function ($query) use ($nextWord) {
            $query->skip($nextWord)->take(1);
            $query->orderBy('created_at', 'desc');
        }])->find($lessonID);
    }

    public static function wordsCorrect($userID, $lessonID, $correct = 1)
    {
        return LessonWord::whereHas('wordAnswer', function ($query) use ($correct) {
            $query->where('correct', $correct);
        })->where(['user_id' => $userID, 'lesson_id' => $lessonID])->count();
    }
}
