<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    public static $errors;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rulesUpdate = array(
        'name' => 'required|min:6'
    );

    public static $rulesCreate = array(
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
        'image' => 'required|image|max:1024'
    );

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public static function validateUpdate($data)
    {
        $validate = Validator::make($data, self::$rulesUpdate);

        if ($validate->fails()) {
            self::$errors = $validate->errors()->all();

            return false;
        }

        return true;
    }

    public static function validateCreate($data)
    {
        return Validator::make($data, self::$rulesCreate);
    }

    public static function getErrors()
    {
        return self::$errors;
    }
}
