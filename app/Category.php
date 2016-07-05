<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
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
}
