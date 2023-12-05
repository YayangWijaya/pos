<?php

namespace App\Http\Controllers;

use App\Exports\TransactionExport;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Pdf;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $transactions = Transaction::with(['user', 'items.product'])->when($request->keyword, function ($q) use ($request) {
                            $q->where('name', 'ILIKE', "%" . $request->keyword . "%");
                        })->when(isset($request->from) && isset($request->to), function ($q) use ($request) {
                            if ($request->from === $request->to) {
                                $q->whereDate('created_at', $request->from);
                            } else {
                                $q->whereBetween('created_at', [$request->from, $request->to]);
                            }
                        })->orderBy('id','desc')->paginate(5);

        return view('backend.transaction.index', compact('transactions'));
    }

    public function create()
    {
        return view('transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        DB::beginTransaction();

        try {
            auth()->user()->carts()->where('qty', '<', 1)->delete();

            $total = 0;
            $carts = auth()->user()->carts;
            $carts->load(['product.inventory']);

            foreach ($carts as $cart) {
                if ($cart->qty > $cart->product->quantity) {
                    return response(['status' => 'error', 'message' => 'Stok tidak tersedia'], 500);
                }
                $total += $cart->product->price * $cart->qty;
            }

            $data = Transaction::create([
                'amount' => $total,
                'user_id' => auth()->id(),
                'paid' => $request->paid,
                'exchange' => ($request->paid - $total),
                'customer_name' => $request->customer_name,
                'note' => $request->note,
            ]);


            foreach ($carts as $cart) {
                $inventory = $cart->product->inventory->take($cart->qty);

                foreach ($inventory as $item) {
                    $data->items()->create([
                        'product_id' => $cart->product->id,
                        'inventory_item_id' => $item->id,
                        'quantity' => 1,
                        'price' => $cart->product->price,
                        'purchase_price' => $item->purchase_price,
                    ]);

                    $item->update(['sold' => true]);
                }
            }

            auth()->user()->carts()->delete();

            DB::commit();
            return ['status' => 'success', 'message' => 'Transaksi Berhasil', 'data' => $data];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('backend.transaction.show',compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        return view('transaction.edit',compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $request->validate([
            //
        ]);

        $transaction->update($request->all());

        return redirect()->route('transaction.index')->with('success','Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaction.index')->with('success','Data berhasil dihapus.');
    }

    public function export(Request $request)
    {
        return Excel::download(new TransactionExport($request->from, $request->to), 'transaction.xlsx');
    }

    public function invoice(Transaction $transaction)
    {
        $transaction->load(['items.product']);
        $pdf = Pdf::loadView('exports.invoice', [
            'transaction' => $transaction->toArray()
        ]);
        return $pdf->download('invoice.pdf');
    }
}
