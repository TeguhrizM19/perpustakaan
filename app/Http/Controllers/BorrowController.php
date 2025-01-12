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
      return back()->with('error', 'Stock sedang habis');
    }

    // jika ada buku yg dipinjam stock buku akan berkurang 1
    $books->stock = $books->stock - 1;
    $books->save();

    $borrows = new Borrow;

    $borrows->tgl_peminjaman = $request->input('tgl_peminjaman');
    $borrows->tgl_kembali = $request->input('tgl_kembali');
    $borrows->member_id = $request->input('member_id');
    $borrows->book_id = $request->input('book_id');

    $borrows->save();
    return redirect('/borrows')->with('success', 'Data Berhasil Disimpan');
  }

  public function selesai($id)
  {
    $peminjaman = Borrow::find($id);
    $books = Book::find($peminjaman->book_id);

    $peminjaman->status = 'Kembali';

    // jika tombol selesai ditekan stock buku akan kembali
    $books->stock = $books->stock + 1;
    $books->save();

    $peminjaman->save();
    return back()->with('success', 'Peminjaman Telah Selesai');
  }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    return view('borrows.edit', [
      'borrow' => Borrow::find($id),
      'books' => Book::all(),
      'members' => Member::all()
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'tgl_peminjaman' => 'required',
      'tgl_kembali' => 'required',
      'member_id' => 'exists:members,id',
      'book_id' => 'exists:books,id'
    ]);

    $borrows = Borrow::find($id);

    $oldBook = Book::find($borrows->book_id);
    $newBook = Book::find($request->book_id);

    if ($oldBook->id != $newBook->id) {
      // Kembalikan stok buku lama
      $oldBook->stock += 1;
      $oldBook->save();

      // Kurangi stok buku baru (jika stock masih ada kurangi)
      if ($newBook->stock > 0) {
        $newBook->stock -= 1;
        $newBook->save();
      } else {
        return back()->with('error', 'Stock buku sedang habis');
      }
    }

    $borrows->tgl_peminjaman = $request->input('tgl_peminjaman');
    $borrows->tgl_kembali = $request->input('tgl_kembali');
    $borrows->member_id = $request->input('member_id');
    $borrows->book_id = $request->input('book_id');

    $borrows->save();
    return redirect('/borrows')->with('success', 'Data Berhasil Diupdate');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $peminjaman = Borrow::find($id);

    if ($peminjaman->status == 'Pinjam') {
      return back()->with('error', 'Data tidak bisa dihapus karena masih ada peminjaman');
    }

    $peminjaman->delete();
    return redirect('/borrows')->with('success', 'Data Berhasil Dihapus');
  }
}
