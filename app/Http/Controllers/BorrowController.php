<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use App\Models\Member;

class BorrowController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $borrows = Borrow::with(['user', 'book'])->get();
    // $borrows = Borrow::all();
    return view('borrows.tampil', compact('borrows'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $members = Member::all();
    $books = Book::all();
    return view('borrows.tambah', compact('members', 'books'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'tgl_peminjaman' => 'required',
      'tgl_kembali' => 'required',
      'member_id' => 'exists:members,id',
      'book_id' => 'exists:books,id'
    ]);

    $books = Book::find($request->book_id);
    if ($books->stock < 1) {
      return back()->with('pesan', 'Stock sedang habis');
    }

    $kurangiStock = $books->stock - 1;
    $books->stock = $kurangiStock;
    $books->save();

    $borrows = new Borrow;

    $borrows->tgl_peminjaman = $request->input('tgl_peminjaman');
    $borrows->tgl_kembali = $request->input('tgl_kembali');
    $borrows->member_id = $request->input('member_id');
    $borrows->book_id = $request->input('book_id');

    $borrows->save();
    return redirect('/borrows');
  }

  public function selesai($id)
  {
    $peminjaman = Borrow::find($id);
    $books = Book::find($peminjaman->book_id);

    $peminjaman->status = 'Kembali';

    // jika tombol selesai ditekan stock buku akan kembali
    $jumlahkanStock = $books->stock + 1;
    $books->stock = $jumlahkanStock;
    $books->save();

    $peminjaman->save();
    return redirect('/borrows');
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
  public function destroy($id)
  {
    $peminjaman = Borrow::find($id);

    if ($peminjaman->status == 'Pinjam') {
      return back()->with('status', 'Data tidak bisa dihapus karena masih ada peminjaman');
    }

    $peminjaman->delete();
    return redirect('/borrows');
  }
}
