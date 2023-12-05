<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cart = Cart::when($request->keyword, function ($q) use ($request) {
                            $q->where('name', 'ILIKE', "%" . $request->keyword . "%");
                        })->orderBy('id','desc')->paginate(5);

        return view('cart.index', compact('cart'));
    }

    public function create()
    {
        return view('cart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        Cart::create($request->all());

        return redirect()->route('cart.index')->with('success','Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        return view('cart.show',compact('cart'));
    }

    public function edit(Cart $cart)
    {
        return view('cart.edit',compact('cart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $request->validate([
            //
        ]);

        $cart->update($request->all());

        return redirect()->route('cart.index')->with('success','Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')->with('success','Data berhasil dihapus.');
    }

    public function addCart(Product $product)
    {
        $cart = Cart::firstOrNew(['user_id' => auth()->id(), 'product_id' => $product->id]);
        $cart->qty = ($cart->qty + 1);
        $cart->save();

        return ['carts' => auth()->user()->carts->load(['product']), 'cart' => $cart, 'cart_total' => auth()->user()->cart_total];
    }

    public function removeCart(Product $product)
    {
        $cart = Cart::where(['user_id' => auth()->id(), 'product_id' => $product->id])->first();

        if (!$cart) {
            return ['carts' => auth()->user()->carts->load(['product']), 'cart' => $cart, 'cart_total' => auth()->user()->cart_total];
        }

        if (intval($cart->qty) < 1) {
            // $cart->delete();
            return ['carts' => auth()->user()->carts->load(['product']), 'cart' => $cart, 'cart_total' => auth()->user()->cart_total];
        }

        $cart->qty = ($cart->qty - 1);
        $cart->save();

        return ['carts' => auth()->user()->carts->load(['product']), 'cart' => $cart, 'cart_total' => auth()->user()->cart_total];
    }
}
