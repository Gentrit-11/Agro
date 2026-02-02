<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierDebtController;
use App\Http\Controllers\ClientDebtController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class)->except(['destroy']);
    Route::patch('/products/{product}/toggle', [ProductController::class, 'toggle'])
        ->name('products.toggle');

    Route::resource('suppliers', SupplierController::class);
    Route::patch('/suppliers/{supplier}/toggle', [SupplierController::class, 'toggle'])
        ->name('suppliers.toggle');

    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');

    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');

    Route::get('/debts', [SupplierDebtController::class, 'index'])->name('debts.index');
    Route::get('/debts/{supplier}', [SupplierDebtController::class, 'show'])->name('debts.show');

    Route::get('/client-debts', [ClientDebtController::class, 'index'])->name('client-debts.index');
    Route::get('/client-debts/{clientName}', [ClientDebtController::class, 'show'])->name('client-debts.show');
});

require __DIR__ . '/auth.php';
