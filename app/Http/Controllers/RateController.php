<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\RateAvg;
use Illuminate\Http\Request;

class RateController extends Controller
{
    // evaluate a post by a user
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

        $avg = Rate::where('post_id', $id)->avg('rate');

        RateAvg::where('post_id', $id)->update([
            'avg' => $avg,
        ]);


        return redirect(route('gallery.post', $id));
    }

    // delete a rate by admin
    public function deleteRate($id)
    {
        if (session()->has('admin')) {

            Rate::destroy($id);
            return redirect(route('gallery.Tables', 'rates'));
        }
    }
}
