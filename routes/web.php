<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');


######### crud using livewire ########
Route::get('category', function () {
    return view('invoice/category');
})->name('category');


Route::get('customer', function () {
    return view('invoice/customer');
})->name('customer');

###### end crud livewire ##########

Route::get('/{page}', [AdminController::class,'index']);


Route::get('{pathMatch}', function () {
    return view('vue-app');
})->where('pathMatch',".*");


});