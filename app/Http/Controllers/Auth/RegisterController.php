<?php

namespace App\Http\Controllers\Auth;

use App\Jobs\registerSaveImageAndSendMail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Api_admin;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $imageNewName='';
        if (file_exists($_FILES['avatar']['tmp_name']) || is_uploaded_file($_FILES['avatar']['tmp_name'])){
            $path_parts = pathinfo($_FILES['avatar']["name"]);
            $imageNewName = 'avatar_' . time() . '.' . $path_parts['extension'];
            Storage::disk('s3')->put('avatar/'.$imageNewName,file_get_contents($_FILES['avatar']['tmp_name']), 'public');
        }
        $data['password'] = bcrypt($data['password']);
        $data['avatar'] = $imageNewName;
        $result = Api_admin::registerAccount($data);
        if(!empty($result)){
            registerSaveImageAndSendMail::dispatch($data)->delay(now()->addMinutes(5));
        }
        return redirect(route('login'));
    }

    public function deleteImage(){
        $path = 'download.jpg';
        $file = Storage::disk('s3')->delete($path);
        dump($file);
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'account' => 'required|string|min:6|max:20|unique:api_admins',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:api_admins',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'account' => $data['account'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
