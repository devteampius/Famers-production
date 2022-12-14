<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use Illuminate\Auth\Events\Registered;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/' . ADMIN;

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $password_hash = bcrypt($data['password']);
       
        return  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>  $password_hash,
            'role' => 0,
            'active' => 1,
        ]);
        
    }

    public function register(Request $request)
    {
        
        $data = $request->all();
        $this->validator($request->all())->validate();
       $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>  '$2y$10$R0BquvBpP6qzOni3b.hQhOY7vCUiMdR2mAHP51wVUfQCjzAVmQ9RS',//bcrypt($data['password']),
            'role' => 0,
            'active' => 1,
        ]);
       
        event(new Registered($user));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
