<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CategoryTrait;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use CategoryTrait;

    public function index(Request $request)
    {
        $products = Product::query();

        if ($request->has('keyword')) {
            $products = $products->where('id', $request['keyword'])
                                ->orwhere('name', 'like', "%{$request['keyword']}%");
        }

        [$column, $direction] = explode(' ', $request->input('order_by', 'id asc'));

        $products = $products->orderBy($column, $direction)->paginate(2);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->getCategories();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $attributes = $request->all();

        $attributes['photo'] = Storage::putFile('products', $request['photo']);

        Product::create($attributes);

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = $this->getCategories();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $attributes = $request->all();

        if (isset($attributes['photo'])) {
            Storage::delete($product->photo);

            $attributes['photo'] = Storage::putFile('products', $request['photo']);
        }

        $product->update($attributes);

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
