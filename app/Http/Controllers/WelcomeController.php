<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller

{

    public function createUser()
    {
        // $data['page_title'] = 'Welcome_NNU';
        // $data['welcome_msg'] = 'The welcome message !!!';

        return view('signup');
    }


    public function addUser(Request $request)
    {
        // $user = User
        // $data['page_title'] = 'Welcome_NNU';
        // $data['welcome_msg'] = 'The welcome message !!!';

        // dd($user);
    }
}
