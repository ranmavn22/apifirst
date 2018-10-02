<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api_admin extends Model
{
    protected $table = "api_admins";

    protected $fillable = ['account','password','group','avatar','name','email','phone','address','birthday','gender','status','last_login'];

    public static function registerAccount($data){
        return self::create($data);
    }
}
