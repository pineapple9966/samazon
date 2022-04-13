<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query();

        if ($request->has('keyword')) {
            $orders = $orders->where('payment_intent_id', 'like', "%{$request['keyword']}%");
        }

        $orders = $orders->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }
}
