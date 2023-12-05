<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('login.auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/addCart/{product}', [CartController::class, 'addCart']);
    Route::post('/removeCart/{product}', [CartController::class, 'removeCart']);
    Route::resource('transaction', TransactionController::class);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('invoice/{transaction}', [TransactionController::class, 'invoice']);

    Route::prefix('admin')->group(function () {
        Route::get('/', function (Request $request) {
            $revenue = TransactionItem::when($request->month && $request->month !== "all", function ($q) use ($request) {
                $q->whereMonth('created_at', $request->month);
            })->when($request->year && $request->year !== "all", function ($q) use ($request) {
                $q->whereYear('created_at', $request->year);
            })->sum('price');
            $capital = TransactionItem::when($request->month && $request->month !== "all", function ($q) use ($request) {
                $q->whereMonth('created_at', $request->month);
            })->when($request->year && $request->year !== "all", function ($q) use ($request) {
                $q->whereYear('created_at', $request->year);
            })->sum('purchase_price');

            $net = $revenue - $capital;
            $orders = TransactionItem::when($request->month && $request->month !== "all", function ($q) use ($request) {
                $q->whereMonth('created_at', $request->month);
            })->when($request->year && $request->year !== "all", function ($q) use ($request) {
                $q->whereYear('created_at', $request->year);
            })->count();
            $products = Product::count();

            return view('backend.index', compact('revenue', 'orders', 'products', 'net'));
        })->name('dashboard');

        Route::resource('product', ProductController::class);
        Route::resource('inventory', InventoryController::class);
        Route::resource('transaction', TransactionController::class);
        Route::resource('user', UserController::class);
        Route::get('export/transaction', [TransactionController::class, 'export'])->name('export.transaction');

    });

});
