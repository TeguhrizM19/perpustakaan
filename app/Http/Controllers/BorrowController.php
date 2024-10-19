<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
  // /**
  //  * Display a listing of the resource.
  //  */
  // public function index()
  // {
  //   $borrows = Borrow::with(['user', 'book'])->get();
  //   // $borrows = Borrow::all();
  //   return view('borrows.tampil', compact('borrows'));
  // }

  // /**
  //  * Show the form for creating a new resource.
  //  */
  // public function create()
  // {
  //   $users = User::all();
  //   $books = Book::all();
  //   return view('borrows.tambah', compact('users', 'books'));
  // }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, $book_id)
  {
    $user_id = Auth::id();
    $request->validate([
      'tgl_peminjaman' => 'required',
      'tgl_kembali' => 'required'
      // 'user_id' => 'exists:users,id',
      // 'book_id' => 'exists:books,id'
    ]);

    // $borrows = new Borrow;
    // $borrows->tgl_peminjaman = $request->input('tgl_peminjaman');
    // $borrows->tgl_kembali = $request->input('tgl_kembali');
    // $borrows->user_id = $request->input('user_id');
    // $borrows->book_id = $request->input('book_id');
    // $borrows->save();

    Borrow::create([
      'tgl_peminjaman' => $request->input('tgl_peminjaman'),
      'tgl_kembali' => $request->input('tgl_kembali'),
      'user_id' => $user_id,
      'book_id' => $book_id
    ]);

    return redirect('/books/' . $book_id);
  }

  /**
   * Display the specified resource.
   */
  public function show(Borrow $borrow)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Borrow $borrow)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Borrow $borrow)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Borrow $borrow)
  {
    //
  }
}
