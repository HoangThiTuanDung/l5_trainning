<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Lesson extends Model
{
    protected $fillable = [
        'name', 'user_id', 'category_id', 'result'
    ];

    public static $rules = [
        'id' => 'required|integer'
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

    public static function validateParams($data)
    {
         $validate = Validator::make($data, self::$rules);

        return $validate->passes();
    }
}
