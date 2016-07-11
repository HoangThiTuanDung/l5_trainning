<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class LessonWord extends Model
{
    public static $errors;
    
    protected $fillable = [
        'user_id', 'lesson_id', 'word_id', 'word_answer_id'
    ];

    public static $rules = [
        'lesson_id' => 'required|integer|exists:lessons,id',
        'word_id' => 'required|integer|exists:words,id',
        'word_answer_id' => 'required|integer|exists:word_answers,id',
        'cur_word'  => 'required|integer'
    ];

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
