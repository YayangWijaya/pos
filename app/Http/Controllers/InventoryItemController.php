<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Http\Requests\StoreInventoryItemRequest;
use App\Http\Requests\UpdateInventoryItemRequest;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $inventoryItem = InventoryItem::when($request->keyword, function ($q) use ($request) {
                            $q->where('name', 'ILIKE', "%" . $request->keyword . "%");
                        })->orderBy('id','desc')->paginate(5);

        return view('inventoryItem.index', compact('inventoryItem'));
    }

    public function create()
    {
        return view('inventoryItem.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryItemRequest $request)
    {
        $request->validate([
            //
        ]);

        InventoryItem::create($request->all());

        return redirect()->route('inventoryItem.index')->with('success','Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryItem $inventoryItem)
    {
        return view('inventoryItem.show',compact('inventoryItem'));
    }

    public function edit(InventoryItem $inventoryItem)
    {
        return view('inventoryItem.edit',compact('inventoryItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryItemRequest $request, InventoryItem $inventoryItem)
    {
        $request->validate([
            //
        ]);

        $inventoryItem->update($request->all());

        return redirect()->route('inventoryItem.index')->with('success','Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryItem $inventoryItem)
    {
        $inventoryItem->delete();
        return redirect()->route('inventoryItem.index')->with('success','Data berhasil dihapus.');
    }
}
