<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{


    //
    public function signup()
    {
        if (session()->has('user')) {
            return view('home');
        } else {
            return view('signup');
        }
    }


    public function insertUser(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|regex:/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/',
            'password_repeat' => 'same:password'
        ]);

        $user = User::where('email', $request->email)->exists();

        if ($user) {
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => sha1($request->password)
            ]);
            return redirect(route('gallery.signup'))->with('signupMsg', 'تم انشاء الحساب بنجاح');
        }
    }

    public function login()
    {
        if (session()->has('user')) {
            return view('home');
        } else {
            return view('login');
        }
    }

    public function extractUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $is_user = User::where([['email', $request->email], ['password', sha1($request->password)]])->exists();

        if ($is_user) {
            $user = User::where([['email', $request->email], ['password', sha1($request->password)]])->first();
            $request->session()->put('user', $user);
            return redirect(route('gallery.home'));
        } else {
            return redirect(route('gallery.login'))->with('loginMsg', 'البريد الالكتروني أو كلمة المرور غير صحيحة');
        }
    }


    public function signout()
    {
        if (session()->has('user')) {
            session()->pull('user');

            return redirect(route('gallery.home'));
        }
    }
}
