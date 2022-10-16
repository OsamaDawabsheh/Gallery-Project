<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function evaluate(Request $request, $id)
    {
        $rate = Rate::where([['user_id', session('user')['id']], ['post_id', $id]])->exists();

        if ($rate) {
            Rate::where('post_id', $id)->update([
                'rate' => $request->rate,
            ]);
        } else {
            Rate::create([
                'rate' => $request->rate,
                'user_id' => session('user')['id'],
                'post_id' => $id,
            ]);
        }

        return redirect(route('gallery.post', $id));
    }
}
