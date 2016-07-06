<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Word extends Model
{
    protected $fillable = [
        'content', 'category_id'
    ];
    public static $errors;
    public static $rules = [
        'category' => 'required|not_in:0',
        'flag' => 'required'
    ];

    public function wordAnswers()
    {
        return $this->hasMany(WordAnswer::class);
    }

    public function lessonWords()
    {
        return $this->hasMany(LessonWord::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public static function wordsCorrect($userID, $correct, $cateID)
    {
        return self::whereHas('lessonWords', function ($query) use ($correct, $userID) {
            $query->where('user_id', $userID);
            $query->whereHas('wordAnswer', function ($q) use ($correct) {
                $q->where('correct', $correct);
            });
        })->where('category_id', $cateID)->get();
    }

    public static function validateRequest($data)
    {
        $validate = Validator::make($data, self::$rules);

        if ($validate->fails()) {
            self::$errors = $validate->errors()->all();

            return false;
        }

        return true;
    }

    public static function getErrors()
    {
        return self::$errors;
    }
}
