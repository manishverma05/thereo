<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $name = explode(' ', $data['name']);
        return User::create([
                    'username' => uniqid(),
                    'firstname' => $name[0],
                    'middlename' => '',
                    'lastname' => end($name),
                    'email' => $data['email'],
                    'role_id' => 2,
                    'password' => Hash::make($data['password']),
        ]);
    }

    /*
     * override the $redirectTo according to user role.
     */

    public function redirectTo() {

        // User role
        $role = auth()->user()->role_id;

        // Check user role
        switch ($role) {
            case 1:
                return '/admin/dashboard';
                break;
            default:
                return '/landing';
                break;
        }
    }

}
