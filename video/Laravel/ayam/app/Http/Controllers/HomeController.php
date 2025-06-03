<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $promoProducts = Product::where('is_promo', true)->take(4)->get();
        $featuredProducts = Product::inRandomOrder()->take(8)->get();
        
        return view('home', compact('promoProducts', 'featuredProducts'));
    }
}
