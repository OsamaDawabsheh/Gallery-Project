<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
                'password' => sha1($request->password),
                'admin' => '0'
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


        $is_user = User::where([['email', $request->email], ['password', sha1($request->password)]])->exists();

        if ($is_user) {
            $user = User::where([['email', $request->email], ['password', sha1($request->password)]])->first();

            if ($user->admin == 1) {
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

    // to move to the home page
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


    // to show contact page
    public function contact()
    {
        return view('contact');
    }

    // send the message
    public function send(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];


        session()->put('sendMsg', $data['message']);


        Mail::send('template-email', $data, function ($message) use ($data) {
            $message->from($data['email'], $data['name']);
            $message->sender($data['email'], $data['name']);
            $message->to('omad10200099@gmail.com', 'Osama Dawabsheh');
            $message->replyTo($data['email'], $data['name']);
            $message->subject('OD Gallery');
        });



        return redirect(route('gallery.contact'))->with('sendEmail', 'تم ارسال الرسالة بنجاح');
    }
}
