<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use CategoryTrait;

    public function index()
    {
        $data = [
            'categories' => $this->getCategories(),
            'recommends' => Product::where('is_recommended', true)->limit(3)->get(),
            'newArrivals' => Product::orderBy('id', 'desc')->limit(4)->get(),
        ];

        return view('home', $data);
    }
}
