<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

Route::get('/', function (Request $request) {

    $query = Product::query();

    if ($request->search) {
        $query->where('name', 'LIKE', '%' . $request->search . '%')
              ->orWhere('brand', 'LIKE', '%' . $request->search . '%');
    }

    $products = $query->latest()->paginate(12);

    return view('welcome', compact('products'));
});

// Route::get('/', function () {
//    // $products = Product::all();
//    $products = Product::latest()->paginate(12);
//     return view('welcome', compact('products'));
// });
Route::get('/product/{id}', function ($id) {
    $product = Product::findOrFail($id);
    return view('product_detail', compact('product'));
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    return redirect('/admin');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/products', ProductController::class);

    Route::get('/admin/inventory', [InventoryController::class, 'index']);
    Route::put('/admin/inventory/{id}', [InventoryController::class, 'update']);
    Route::get('/admin/inventory/{id}/history', [InventoryController::class, 'history']);

    Route::get('/admin/pos', [POSController::class, 'index']);
    Route::post('/admin/pos/checkout', [POSController::class, 'checkout']);

    Route::get('/admin/reports', [ReportController::class, 'index']);
    Route::get('/admin/reports/daily', [ReportController::class, 'daily']);
    Route::get('/admin/reports/daily/export', [ReportController::class, 'exportDailyPdf']);
    Route::get('/admin/reports/filtered', [ReportController::class, 'filtered']);
    Route::get('/admin/reports/profit', [ReportController::class, 'profit']);
    Route::get('/admin/reports/top-products', [ReportController::class, 'topProducts']);

    Route::get('/admin/sales', [SaleController::class, 'index']);
    Route::get('/admin/sales/{id}', [SaleController::class, 'show']);
    Route::get('/admin/sales/{id}/receipt-print', [SaleController::class, 'print']);

});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
