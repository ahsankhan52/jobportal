<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegistrationFromRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';
    const JOB_POSTER = 'employer';
    public function createSeeker(){
        return view('user.register-seeker');
    }

    public function createEmployer(){
        return view('user.register-employer');
    }

    public function storeSeeker(RegistrationFromRequest $request){
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);
        $user = User::create([
            // 'name' => $request->get('name')
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_type' => self::JOB_SEEKER,
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return response()->json('success');

        // return redirect()->route('verification.notice')->with('successMessage', 'Your account was created');
    }

    public function storeEmployer(RegistrationFromRequest $request){
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        $user = User::create([
            // 'name' => $request->get('name')
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_type' => self::JOB_POSTER,
            'user_trial' => now()->addWeek()
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return response()->json('success');

        // return redirect()->route('verification.notice')->with('successMessage', 'Your account was created');
    }

    public function login(){
        return view('user.login');
    }

    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended('dashboard');
        }

        return 'Wrong email or password';
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
