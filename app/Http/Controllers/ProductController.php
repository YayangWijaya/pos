<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with(['image'])->when($request->keyword, function ($q) use ($request) {
                            $q->where('name', 'ILIKE', "%" . $request->keyword . "%");
                        })->orderBy('id','desc')->paginate(100);

        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();

        try {

            $product = Product::create($request->all());

            $image = $request->file('image');
            $filename = uniqid().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('images', $filename, 'public');

            $product->image()->create([
                'name' => $image->getClientOriginalName(),
                'path' => $path,
                'mime' => $image->getClientMimeType(),
                'size' => $image->getSize()
            ]);

            DB::commit();
            return redirect()->route('product.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('product.index')->with('error', "Data gagal disimpan: {$e->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('backend.product.show',compact('product'));
    }

    public function edit(Product $product)
    {
        return view('backend.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validate([
            //
        ]);

        $product->update($request->all());

        return redirect()->route('product.index')->with('success','Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Cart::whereProductId($product->id)->delete();
        $product->delete();
        return redirect()->route('product.index')->with('success','Data berhasil dihapus.');
    }
}
