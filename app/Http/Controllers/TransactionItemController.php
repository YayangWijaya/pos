<?php

namespace App\Http\Controllers;

use App\Models\TransactionItem;
use App\Http\Requests\StoreTransactionItemRequest;
use App\Http\Requests\UpdateTransactionItemRequest;
use Illuminate\Http\Request;

class TransactionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $transactionItem = TransactionItem::when($request->keyword, function ($q) use ($request) {
                            $q->where('name', 'ILIKE', "%" . $request->keyword . "%");
                        })->orderBy('id','desc')->paginate(5);

        return view('transactionItem.index', compact('transactionItem'));
    }

    public function create()
    {
        return view('transactionItem.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionItemRequest $request)
    {
        $request->validate([
            //
        ]);

        TransactionItem::create($request->all());

        return redirect()->route('transactionItem.index')->with('success','Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionItem $transactionItem)
    {
        return view('transactionItem.show',compact('transactionItem'));
    }

    public function edit(TransactionItem $transactionItem)
    {
        return view('transactionItem.edit',compact('transactionItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionItemRequest $request, TransactionItem $transactionItem)
    {
        $request->validate([
            //
        ]);

        $transactionItem->update($request->all());

        return redirect()->route('transactionItem.index')->with('success','Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionItem $transactionItem)
    {
        $transactionItem->delete();
        return redirect()->route('transactionItem.index')->with('success','Data berhasil dihapus.');
    }
}
