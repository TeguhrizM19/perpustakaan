<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
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

// Route::middleware(['auth'])->group(function () {
// });

// CRUD category
Route::resource('/category', CategoryController::class);

// CRUD book
Route::resource('/books', BooksController::class);

Auth::routes();

// CRUD Peminjaman
Route::resource('/borrows', BorrowController::class);
Route::put('/borrows/{id}/selesai', [BorrowController::class, 'selesai']);

// CRUD Member
Route::resource('/members', MemberController::class);

// Halaman User
Route::get('/users', [UserController::class, 'index']);
