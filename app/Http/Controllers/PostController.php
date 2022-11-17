<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Rate;
use App\Models\RateAvg;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    // show home page
    public function home()
    {
        $topPosts = RateAvg::with('post')->whereRelation('post', 'state', 'عام')->orderBy('avg', 'desc')->take(3)->get();
        $posts = Post::with('user')->where('state', 'عام')->orderBy('id', 'desc')->paginate(20);

        if (session()->has('admin')) {
            return redirect(route('gallery.admin'));
        }


        return view('home', [
            'posts' => $posts,
            'topPosts' => $topPosts,
        ]);
    }

    // show post page
    public function post($id)
    {
        if (session()->has('admin')) {
            return redirect(route('gallery.admin'));
        }

        $post =  Post::with('user')->findOrFail($id);
        $rate = '';
        if (session()->has('user')) {
            $rate = Rate::where([['user_id', session('user')['id']], ['post_id', $id]])->first();
        }
        $ratesNumber = Rate::where('post_id', $id)->count();
        $ratesAvg = Rate::where('post_id', $id)->avg('rate');
        $ratesAvg = floatval(number_format($ratesAvg, 1, '.', ','));
        $comments = Comment::orderBy('created_at', 'desc')->get();


        return view('post', [
            'post' => $post,
            'rate' => $rate,
            'count' => $ratesNumber,
            'avg' => $ratesAvg,
            'comments' => $comments,
        ]);
    }

    // show create post page
    public function newPost()
    {
        if (session()->has('user') || session()->has('admin')) {
            return view('create');
        } else {
            return view('login');
        }
    }

    // to create a new post
    public function insertPost(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:posts',
            'description' => 'required',
            'position' => 'required',
            'image' => 'required|image',
            'state' => 'required'
        ]);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'position' => $request->position,
            'image_path' => $this->saveImage($request),
            'state' => $request->state,
            'user_id' => isset(session('user')['id']) ?  session('user')['id'] : session('admin')['id'],
        ]);

        $avg = 0;

        RateAvg::create([
            'avg' => 0,
            'post_id' => $post->id
        ]);

        if (session()->has('admin')) {
            return redirect(route('gallery.admin'));
        }

        return redirect(route('gallery.home'));
    }

    // to save  an image in assests folder
    public function saveImage($request, $id = 0)
    {
        $post = Post::where('id', $id)->first();
        $des = isset($post->image_path) ? $post->image_path : '';
        if (File::exists($des)) {
            File::delete($des);
        }
        $newImage = $request->title . '.' . $request->image->extension();
        return $request->image->move('assets/images/', $newImage);
    }

    // show post edit page
    public function edit($id)
    {
        $post = Post::where('id', $id)->first();

        if (session()->has('user') && session('user')['id'] == $post->user_id || session()->has('admin')) {
            return view('update', [
                'post' => Post::where('id', $id)->first()
            ]);
        } else {
            return view('login');
        }
    }

    // to update a post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:posts,title,' . $id,
            'description' => 'required',
            'position' => 'required',
            'image' => 'image',
            'state' => 'required'
        ]);


        $post = Post::where('id', $id)->first();
        $img = $post->image_path;

        if ($request->file('image')) {
            $img = $this->saveImage($request, $id);
        }

        Post::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'position' => $request->position,
            'image_path' => $img,
            'state' => $request->state
        ]);

        if (session()->has('admin')) {
            return redirect(route('gallery.Tables', 'posts'));
        }

        return redirect(route('gallery.post', $id));
    }

    // show an user's page
    public function user($id, $state)
    {
        if (session()->has('user') && session('user')['id'] == $id) {
            $owner = 1;
            if ($state == "الكل") {
                $posts = POST::where('user_id', $id)->orderBy('id', 'desc')->paginate(20);
            } else if ($state == "عام") {
                $posts = POST::where('user_id', $id)->where('state', 'عام')->orderBy('id', 'desc')->paginate(20);
            } else {
                $posts = POST::where('user_id', $id)->where('state', 'خاص')->orderBy('id', 'desc')->paginate(20);
            }
        } else {
            $owner = 0;
            $posts = POST::where([['user_id', $id], ['state', 'عام']])->orderBy('id', 'desc')->paginate(20);
        }

        if (session()->has('admin')) {
            return redirect(route('gallery.admin'));
        }

        return view('user', [
            'posts' => $posts,
            'owner' => $owner
        ]);
    }

    // to delete a post
    public function remove($id)
    {
        $post = Post::find($id);
        $des = $post->image_path;
        if (File::exists($des)) {
            File::delete($des);
        }

        Post::destroy($id);
        if (session()->has('admin')) {
            return redirect(route('gallery.Tables', 'posts'));
        }
        return redirect(route('gallery.home'))->with('delete', 'تم حذف المنشور ');
    }

    // to download a post's image
    public function download($id)
    {
        $post = Post::where('id', $id)->first();

        return response()->download($post->image_path);
    }


    // search posts using filtering in the home page or dashboard page
    public function search(Request $request)
    {

        $filter = $request->filter;
        $search = $request->search;

        $currentYear = date("Y");

        $year5 = Post::with('user')->where('created_at', 'like', '%' . $currentYear . '%')->count();
        $year4 = Post::with('user')->where('created_at', 'like', '%' . $currentYear - 1 . '%')->count();
        $year3 = Post::with('user')->where('created_at', 'like', '%' . $currentYear - 2 . '%')->count();
        $year2 = Post::with('user')->where('created_at', 'like', '%' . $currentYear - 3 . '%')->count();
        $year1 = Post::with('user')->where('created_at', 'like', '%' . $currentYear - 4 . '%')->count();

        $topPosts = RateAvg::with('post')->whereRelation('post', 'state', 'عام')->orderBy('avg', 'desc')->take(3)->get();

        if ($filter == 'name') {
            $posts = Post::with('user')->Where('state', 'عام')->orderBy('created_at', 'desc')->whereRelation('user', $filter, 'LIKE',  '%' . $search . '%')->paginate(20);

            if (session()->has('admin')) {
                $posts = Post::with('user')->orderBy('created_at', 'desc')->whereRelation('user', $filter, 'LIKE',  '%' . $search . '%')->paginate(20);

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
            }
            return view('home', [
                'posts' => $posts,
                'topPosts' => $topPosts,
            ]);
        } else if ($filter == 'rate') {
            $posts = Post::with('user')->Where('state', 'عام')->orderBy('created_at', 'desc')->whereRelation('rate', $filter, 'LIKE',  '%' . $search . '%')->paginate(20);

            if (session()->has('admin')) {
                $posts = Post::with('user')->orderBy('created_at', 'desc')->whereRelation('rate', $filter, 'LIKE',  '%' . $search . '%')->paginate(20);

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
            }
            return view('home', [
                'posts' => $posts,
                'topPosts' => $topPosts,
            ]);
        } else {
            if (session()->has('admin')) {
                $posts = Post::with('user')->orderBy('created_at', 'desc')->where($filter, 'LIKE',  '%' . $search . '%')->paginate(20);
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
            }
            $posts = Post::with('user')->Where('state', 'عام')->orderBy('created_at', 'desc')->where($filter, 'LIKE',  '%' . $search . '%')->paginate(20);
            return view('home', [
                'posts' => $posts,
                'topPosts' => $topPosts,
            ]);
        }
    }
}
