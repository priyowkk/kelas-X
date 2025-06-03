<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        return view('menu', compact('categories'));
    }
    
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('product.show', compact('product'));
    }
    
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products;
        return view('product.category', compact('category', 'products'));
    }
}
