<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MyTransactionController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product', [FrontendController::class, 'product'])->name('product');
Route::get('/details/{slug}', [FrontendController::class, 'details'])->name('details');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
    Route::post('/cart/{id}', [FrontendController::class, 'cartAdd'])->name('cart-add');
    Route::delete('/cart/{id}', [FrontendController::class, 'cartDelete'])->name('cart-delete');
    Route::post('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [FrontendController::class, 'success'])->name('checkout-success');

});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
   
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::resource('my-transaction', MyTransactionController::class)->only([
            'index', 'show', 'create'
        ]);

        Route::get('my-transaction/transaction/{id}', [MyTransactionController::class, 'transaction'])->name('transaction');
        Route::post('my-transaction/transaction/{id}', [MyTransactionController::class, 'upload'])->name('transaction-upload');

        Route::middleware(['admin'])->group(function () {
            Route::resource('product', ProductController::class);
            Route::resource('category', ProductCategoryController::class);
            Route::resource('product.gallery', ProductGalleryController::class)->shallow()->only([
                'index', 'create', 'store', 'destroy'
            ]);
            Route::resource('transaction', TransactionController::class)->only([
                'index', 'show', 'edit', 'update'
            ]);
            Route::resource('user', UserController::class)->only([
                'index', 'edit', 'update', 'destroy'
            ]);

            Route::resource('rekening', RekeningController::class);
            Route::resource('supplier', SupplierController::class);
            // Route::get('rekening', [RekeningController::class, 'index'])->name('rekening-index');
            // Route::post('addRekening', [RekeningController::class, 'store'])->name('addRekening');
            // Route::get('add-rekening', [RekeningController::class, 'create'])->name('add-rekening');
            // Route::get('hapus-rekening', [RekeningController::class, 'index'])->name('hapus-rekening');
            // Route::get('rekening-edit', [RekeningController::class, 'edit'])->name('edit-rekening');
        });
    });
});