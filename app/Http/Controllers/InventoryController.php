<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $inventories = Inventory::with(['product'])->when($request->keyword, function ($q) use ($request) {
                            $q->where('name', 'ILIKE', "%" . $request->keyword . "%");
                        })->orderBy('created_at', 'desc')->paginate(100);

        return view('backend.inventory.index', compact('inventories'));
    }

    public function create()
    {
        $products = Product::get();
        return view('backend.inventory.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $inventory = Inventory::create($request->all());

            for($i = 1;$i <= $request->quantity;$i++) {
                $inventory->items()->create([
                    'product_id' => $request->product_id,
                    'purchase_price' => $request->purchase_price
                ]);
            }

            DB::commit();
            return redirect()->route('inventory.index')->with('success','Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('inventory.index')->with('error', "Data gagal disimpan: {$e->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        return view('backend.inventory.show',compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        return view('backend.inventory.edit',compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $request->validate([
            //
        ]);

        $inventory->update($request->all());

        return redirect()->route('inventory.index')->with('success','Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success','Data berhasil dihapus.');
    }
}
