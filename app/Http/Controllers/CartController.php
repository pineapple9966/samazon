<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('carts.index');
    }

    public function add(Request $request)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => $request->user()->id,
            'product_id' => $request['product_id'],
        ], [
            'qty' => $request['qty'],
        ]);

        if (!$cart->wasRecentlyCreated) {
            $cart->qty += $request['qty'];

            $cart->save();
        }

        return redirect()->route('products.show', $request['product_id']);
    }

    public function update(Request $request, Cart $cart)
    {
        $cart->update(['qty' => $request['qty']]);

        return redirect()->route('carts.index');
    }

    public function destroy(Request $request)
    {
        Cart::whereIn('id', $request['cart_ids'])->delete();

        return response()->json();
    }
}
