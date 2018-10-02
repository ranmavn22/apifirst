<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api_customer extends Model
{
    protected $table = "api_customers";
    protected $fillable = ['account','password','phone','name','email','gender','birthday','address','last_login','service_token','auth_token','status','','account_type'];

    const ACCOUNT = 1;
    const FB = 2;
    const TWITTER = 3;
    const INS = 4;
    const GOOGLE = 5;

    public static function registerUserAccount($data){
        $customer = new self();
        $customer->account = $data['account'];
        $customer->password = bcrypt($data['password']);
        $customer->name = $data['name'];
        $customer->email = $data['email'];
        $customer->account_type = $data['account_type'];
        $customer->auth_token = bcrypt($data['account'].bcrypt($data['password']));
        if($customer->save()){
            return bcrypt($data['account'].bcrypt($data['password']));
        }else{
            return false;
        }

    }
}
