<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
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

// Route::get('/home', [BookController::class, 'index']);

// Route::get('/download/{filename}', [BookController::class, 'download'])->where('filename','.*');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/category', [App\Http\Controllers\HomeController::class, 'getCategory']);

// Routes related to admin category changes
Route::get('/cat', [App\Http\Controllers\HomeController::class, 'category']);
Route::post('/cat-add', [App\Http\Controllers\HomeController::class, 'catAdd']);
Route::post('/cat-update', [App\Http\Controllers\HomeController::class, 'catUpdate']);
Route::post('/cat-delete', [App\Http\Controllers\HomeController::class, 'catDelete']);

// Routes related to book changes
Route::get('/book-view', [App\Http\Controllers\HomeController::class, 'bookView']);
Route::post('/book-add', [App\Http\Controllers\HomeController::class, 'bookAdd']);