<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as TestUserAuth;

class User extends TestUserAuth implements Authenticatable
{
    protected $fillable = ['login', 'name', 'email', 'password', 'idtype'];
    protected $table = "users";

    protected $hidden = ['password', 'remember_token'];

    public $timestamps = false;

    public static function getUserByEmail($email)
    {

        try {
            return User::where('email', $email)->get();
        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public static function getUserByToken($token)
    {

        try {
            return $save = User::where([['remember_token', '=', token],
                ['remember_token', '<>', '']])->get();

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }
}
