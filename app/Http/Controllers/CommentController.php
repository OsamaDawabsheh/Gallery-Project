<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // comment on post by users
    public function comment(Request $request, $id)
    {

        $request->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'comment' => $request->comment,
            'user_id' => session('user')['id'],
            'post_id' => $id,
        ]);

        return redirect(route('gallery.post', $id));
    }

    // to delete a comment
    public function delete($id)
    {
        $comment = Comment::with('post')->where('id', $id)->first();

        if (session()->has('user') && session('user')['id'] == $comment->post->user->id) {
            Comment::destroy($id);
            return redirect(route('gallery.post', $comment->post->id))->with('commentDelete', 'تم حذف التعليق');
        } else if (session()->has('admin')) {
            Comment::destroy($id);
            return redirect(route('gallery.Tables', 'comments'));
        }

        return redirect(route('gallery.home'));
    }

    // show edit comment page
    public function editComment($id)
    {
        $comment = Comment::with('post')->where('id', $id)->first();

        if (session()->has('user') &&  session('user')['id'] == $comment->post->user->id || session()->has('admin')) {
            return view('edit', [
                'commentText' => Comment::where('id', $id)->first()
            ]);
        }

        return redirect(route('gallery.home'));
    }

    // update a comment
    public function updateComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment =  Comment::where('id', $id)->first();

        Comment::where('id', $id)->update([
            'comment' => $request->comment,
        ]);

        if (session()->has('user') &&  session('user')['id'] == $comment->post->user->id) {
            return redirect(route('gallery.post', $comment->post_id))->with('commentEdit', 'تم تعديل التعليق');
        } else if (session()->has('admin')) {
            return redirect(route('gallery.Tables', 'comments'));
        }
    }
}
