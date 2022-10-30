<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Rate;
use App\Models\RateAvg;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // show admin dashboard page
    public function admin()
    {
        $topPosts = RateAvg::with('post')->orderBy('avg', 'desc')->take(3)->get();
        $posts = Post::with('user', 'rate')->orderBy('id', 'desc')->paginate(20);

        $currentYear = date("Y");

        $year5 = Post::with('user')->where('created_at', 'like', '%' . $currentYear . '%')->count();
        $year4 = Post::with('user')->where('created_at', 'like', '%' . $currentYear - 1 . '%')->count();
        $year3 = Post::with('user')->where('created_at', 'like', '%' . $currentYear - 2 . '%')->count();
        $year2 = Post::with('user')->where('created_at', 'like', '%' . $currentYear - 3 . '%')->count();
        $year1 = Post::with('user')->where('created_at', 'like', '%' . $currentYear - 4 . '%')->count();


        if (session()->has('admin')) {
            return view('dashboard', [
                'posts' => $posts,
                'topPosts' => $topPosts,
                'currentYear' => $currentYear,
                'year1' => $year1,
                'year2' => $year2,
                'year3' => $year3,
                'year4' => $year4,
                'year5' => $year5,
            ]);
        } else if (session()->has('user')) {
            return redirect(route('gallery.home'));
        } else {
            return redirect(route('gallery.login'));
        }
    }

    // show database table for admin
    public function tables(Request $request, $table)
    {

        if (session()->has('admin')) {

            $users = '';
            $posts = '';
            $rates = '';
            $comments = '';


            if ($table == 'users') {
                $users = User::orderBy('created_at', 'desc')->paginate(20);
                return view('tables', [
                    'users' => $users,
                ]);
            }
            if ($table == 'posts') {
                $posts = Post::orderBy('created_at', 'desc')->paginate(20);
                return view('tables', [
                    'posts' => $posts,
                ]);
            }
            if ($table == 'rates') {
                $rates = Rate::orderBy('created_at', 'desc')->paginate(20);
                return view('tables', [
                    'rates' => $rates,
                ]);
            }
            if ($table == 'comments') {
                $comments = Comment::orderBy('created_at', 'desc')->paginate(20);
                return view('tables', [
                    'comments' => $comments,
                ]);
            }
        }
    }

    // search in the database tables using filtering
    public function tableSearch(Request $request, $table)
    {

        $filter = $request->filter;
        $search = $request->search;

        $users = '';
        $posts = '';
        $rates = '';
        $comments = '';


        if (session()->has('admin')) {
            if ($table == 'users') {
                $users = User::orderBy('created_at', 'desc')->where($filter, 'LIKE',  '%' . $search . '%')->paginate(20);
                return view('tables', [
                    'users' => $users,
                ]);
            } else if ($table == 'posts') {
                $posts = Post::with('user')->orderBy('created_at', 'desc')->where($filter, 'LIKE',  '%' . $search . '%')->paginate(20);
                return view('tables', [
                    'posts' => $posts,
                ]);
            } else if ($table == 'rates') {
                $rates = Rate::with('user')->orderBy('created_at', 'desc')->where($filter, 'LIKE',  '%' . $search . '%')->paginate(20);
                return view('tables', [
                    'rates' => $rates,
                ]);
            } else if ($table == 'comments') {
                $comments = Comment::with('user')->orderBy('created_at', 'desc')->where($filter, 'LIKE',  '%' . $search . '%')->paginate(20);
                return view('tables', [
                    'comments' => $comments,
                ]);
            }
        }
    }
}
