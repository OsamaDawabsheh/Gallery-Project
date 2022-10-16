<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function home()
    {

        $posts = Post::with('user')->where('state', 'عام')->orderBy('id', 'desc')->paginate(20);
        // $users = User::where('state', 'عام')->orderBy('id', 'desc')->user;
        return view('home', ['posts' => $posts,]);
    }

    public function post($id)
    {
        $post =  Post::with('user')->findOrFail($id);
        $rate = Rate::where([['user_id', session('user')['id']], ['post_id', $id]])->first();
        $ratesNumber = Rate::where('post_id', $id)->count();
        $ratesAvg = Rate::where('post_id', $id)->avg('rate');
        $ratesAvg = floatval(number_format($ratesAvg, 1, '.', ','));

        return view('post', [
            'post' => $post,
            'rate' => $rate,
            'count' => $ratesNumber,
            'avg' => $ratesAvg,
        ]);
    }


    public function newPost()
    {
        if (session()->has('user')) {
            return view('create');
        } else {
            return view('login');
        }
    }


    public function insertPost(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:posts',
            'description' => 'required',
            'position' => 'required',
            'image' => 'required|image',
            'state' => 'required'
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'position' => $request->position,
            'image_path' => $this->saveImage($request),
            'state' => $request->state,
            'user_id' => session('user')['id']
        ]);


        return redirect(route('gallery.home'));
    }

    public function saveImage($request)
    {

        $newImage = $request->title . '.' . $request->image->extension();
        return $request->image->move('assets/images/', $newImage);
    }

    public function edit($id)
    {
        if (session()->has('user')) {
            return view('update', [
                'post' => Post::where('id', $id)->first()
            ]);
        } else {
            return view('login');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:posts,title,' . $id,
            'description' => 'required',
            'position' => 'required',
            'image' => 'image',
            'state' => 'required'
        ]);


        $post = Post::where('title', $request->title)->exists();

        if ($request->file('image')) {
            Post::where('id', $id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'position' => $request->position,
                'image_path' => $this->saveImage($request),
                'state' => $request->state
            ]);
        } else {
            Post::where('id', $id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'position' => $request->position,
                'state' => $request->state
            ]);
        }

        return redirect(route('gallery.post', $id));
    }


    public function user($id)
    {
        $posts = POST::where('user_id', $id)->orderBy('id', 'desc')->paginate(20);
        $user = User::where('id', $id)->first();
        return view('user', [
            'posts' => $posts,
            'user' => $user
        ]);
    }

    public function remove($id)
    {
        $post = Post::find($id);
        $des = $post->image_path;
        if (File::exists($des)) {
            File::delete($des);
        }

        Post::destroy($id);
        return redirect(route('gallery.home'))->with('delete', 'تم حذف المنشور ');
    }


    public function download($id)
    {
        $post = Post::where('id', $id)->first();

        return response()->download($post->image_path);
    }
}
