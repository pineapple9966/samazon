<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        if ($request['group_by'] == 'daily') {
            $date = "strftime('%Y-%m-%d', created_at)";
        } else {
            $date = "strftime('%Y-%m', created_at)";
        }

        $sales = DB::table('orders')
            ->select(DB::raw("{$date} as date, count(payment_intent_id) as count, sum(total_amount) as amount, avg(total_amount) as avg"))
            ->groupBy('date')
            ->paginate(30);

        return view('admin.sales.index', compact('sales'));
    }
}
