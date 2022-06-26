<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', [ProductController::class, 'index']);
Route::post('/store', [ProductController::class, 'store'])->name('store');
Route::get('/fetchall', [ProductController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete', [ProductController::class, 'delete'])->name('delete');
Route::get('/edit', [ProductController::class, 'edit'])->name('edit');
Route::post('/update', [ProductController::class, 'update'])->name('update');