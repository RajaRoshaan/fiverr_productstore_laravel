<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/add-product', [ItemController::class, 'store'])->name('product.add');
    Route::get('/product-form', function(){
        return view('product-form');
    })->name('product.form');
    Route::get('/edit-product/{id}', [ItemController::class, 'edit'])->name('product.edit');
    Route::post('/edit-product/{id}', [ItemController::class, 'update'])->name('product.update');
    Route::get('/delete-product/{id}', [ItemController::class, 'destroy'])->name('product.destroy');
    Route::post('/shop-buy', [TransactionController::class, 'store'])->name('shop.buy');
    Route::get('/purchased', [TransactionController::class, 'get_purchased'])->name('purchased');
    Route::get('/sold', [TransactionController::class, 'get_sold'])->name('sold');
});

Route::get('/', [ItemController::class, 'all'])->name('shop');
Route::get('/shop-item/{id}', [ItemController::class, 'item'])->name('shop.item');
Route::get('/shop/filter', [ItemController::class, 'filter'])->name('shop.filter');

require __DIR__.'/auth.php';
