<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Category extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public static $rules = [
        'id' => 'required|integer'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function wordsCorrect($userID, $cateID, $correct)
    {
        $data = Lesson::whereHas('lessonWords', function ($query) use ($correct) {
            $query->whereHas('wordAnswer', function ($q) use ($correct) {
                $q->where('correct', $correct);
            });
        })->where(['user_id' => $userID, 'category_id' => $cateID])->count();
        
        return $data;
    }

    public static function validateParams($data)
    {
         $validate = Validator::make($data, self::$rules);

        return $validate->passes();
    }
}
