<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use CategoryTrait;

    public function index(Request $request, Category $category)
    {
        $categories = $this->getCategories();

        [$column, $direction] = explode(' ', $request->input('order_by', 'id asc'));

        $products = $category->products()->orderBy($column, $direction)->paginate(2);

        return view('products.index', compact('category', 'categories', 'products'));
    }

    public function show(Request $request, Product $product)
    {
        $categories = $this->getCategories();

        $favorite = $request->user()?->favorites()->where('product_id', $product->id)->first();

        $reviews = $product->reviews;

        return view('products.show', compact('product', 'categories', 'favorite', 'reviews'));
    }

    public function review(Request $request, Product $product)
    {
        $product->reviews()->create([
            'user_id' => $request->user()->id,
            'score' => $request['score'],
            'body' => $request['body'],
        ]);

        return redirect()->route('products.show', $product->id);
    }
}
