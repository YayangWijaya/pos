<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 1) {
            return redirect()->route('dashboard');
        }

        $products = Product::get();
        $carts = auth()->user()->carts->where('qty', '>', 0);
        return view('index', compact('products', 'carts'));
    }
}
