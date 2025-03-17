<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('inventories', InventoryController::class);
Route::resource('products', ProductController::class);


Route::get('/get-product-by-sku', function (Request $request) {
    $sku = $request->input('sku');
    $product = Product::where('sku', $sku)->first();

    if ($product) {
        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Product not found'
        ]);
    }
});

