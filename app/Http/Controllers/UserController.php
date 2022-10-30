<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // show a signup page
    public function signup()
    {
        if (session()->has('user')) {
            return redirect(route('gallery.home'));
        } else if (session()->has('admin')) {
            return redirect(route('gallery.admin'));
        } else {
            return view('signup');
        }
    }

    // create a user's account
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

    // show login page
    public function login()
    {
        if (session()->has('user')) {
            return redirect(route('gallery.home'));
        } else if (session()->has('admin')) {
            return redirect(route('gallery.admin'));
        } else {
            return view('login');
        }
    }

    // login to user's account
    public function extractUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = 'osama@gmail.com';

        $is_user = User::where([['email', $request->email], ['password', sha1($request->password)]])->exists();

        if ($is_user) {
            $user = User::where([['email', $request->email], ['password', sha1($request->password)]])->first();

            if ($user->email == $admin) {
                $request->session()->put('admin', $user);
                return redirect(route('gallery.admin'));
            }

            $request->session()->put('user', $user);
            return redirect(route('gallery.home'));
        } else {
            return redirect(route('gallery.login'))->with('loginMsg', 'البريد الالكتروني أو كلمة المرور غير صحيحة');
        }
    }

    // user signout of his account
    public function signout()
    {
        if (session()->has('admin')) {
            session()->pull('admin');
            return redirect(route('gallery.home'));
        }
        if (session()->has('user')) {
            session()->pull('user');
            return redirect(route('gallery.home'));
        }
    }

    // to move to the home(index) page
    public function goToHome()
    {
        if (session()->has('admin')) {
            return redirect(route('gallery.admin'));
        } else {
            return redirect(route('gallery.home'));
        }
    }

    // to delete a user by admin
    public function deleteUser($id)
    {

        User::destroy($id);

        return redirect(route('gallery.Tables', 'users'));
    }
}
