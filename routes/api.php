<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

## route for view (index.vue )
Route::get('get_all_invoice', [InvoiceController::class, 'index']);
Route::get('search_invoice', [InvoiceController::class, 'search_invoice']);
## route for view (new.vue )
Route::get('get_all_customers', [CustomerController::class, 'index']);
Route::get('create_invoice', [InvoiceController::class, 'create_invoice']);
Route::get('get_categories', [CategoryController::class, 'index']);
Route::post('add_invoice', [InvoiceController::class, 'store']);