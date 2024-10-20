<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

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
  return view('index');
});

// CRUD category
Route::resource('/category', CategoryController::class);

// CRUD book
Route::resource('/books', BooksController::class);

Auth::routes();

Route::middleware(['auth'])->group(function () {
  Route::post('/borrow/{book_id}', [BorrowController::class, 'store']);
});

// Halaman User
Route::get('/users', [UserController::class, 'index']);
