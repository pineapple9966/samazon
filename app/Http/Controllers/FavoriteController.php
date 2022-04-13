<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FavoriteController extends Controller
{
    public function index()
    {
        return view('favorite');
    }

    public function addDestroy(Request $request)
    {
        $favorite = Favorite::firstOrCreate([
            'user_id' => $request->user()->id,
            'product_id' => $request['product_id'],
        ]);

        if (!$favorite->wasRecentlyCreated) {
            $favorite->delete();
        }

        return redirect()->route('products.show', $request['product_id']);
    }

    public function destroy(Request $request)
    {
        Favorite::whereIn('id', $request['favorite_ids'])->delete();

        return response()->json();
    }
}
