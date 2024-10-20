<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
  public function store(Request $request, $book_id)
  {
    $user_id = Auth::id();
    $request->validate([
      'tgl_peminjaman' => 'required',
      'tgl_kembali' => 'required'
    ]);

    Borrow::create([
      'tgl_peminjaman' => $request->input('tgl_peminjaman'),
      'tgl_kembali' => $request->input('tgl_kembali'),
      'user_id' => $user_id,
      'book_id' => $book_id
    ]);

    return redirect('/books/' . $book_id);
  }
}
