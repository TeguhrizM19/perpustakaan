<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class BooksController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->except(['index', 'show']);
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('books.tampil', [
      'books' => Book::all()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = Category::all();
    return view('books.tambah', compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required',
      'summary' => 'required',
      'releas_year' => 'required',
      'category_id' => 'required|exists:categories,id',
      'stock' => 'required',
      'image' => 'nullable|mimes:jpg,jpeg,png|max:2048'
    ]);

    if ($request->file('image')) {
      // mengubah naman file jadi unique
      $newNameImage = time() . '.' . $request->image->extension();
      // tempat penyimpanan image
      $request->image->move(public_path('uploads'), $newNameImage);

      $validated['image'] = $newNameImage;
    }

    Book::create($validated);

    return redirect('/books')->with('success', 'Data Berhasil Ditambahkan');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $book = Book::find($id);
    return view('books.detail', compact('book'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $book = Book::find($id);
    $categories = Category::all();
    return view('books.edit', compact('book', 'categories'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validated = $request->validate([
      'title' => 'required',
      'summary' => 'required',
      'releas_year' => 'required',
      'category_id' => 'required|exists:categories,id',
      'stock' => 'required',
      'image' => 'mimes:jpg,jpeg,png|max:2048'
    ]);

    $books = Book::find($id);

    if ($request->file('image')) {
      // Hapus file lama
      File::delete('uploads/' . $books->image);
      // mengubah naman file jadi unique
      $newNameImage = time() . '.' . $request->image->extension();
      // tempat penyimpanan image
      $request->image->move(public_path('uploads'), $newNameImage);

      $validated['image'] = $newNameImage;
    }

    $books->update($validated);

    return redirect('/books')->with('success', 'Data Berhasil Diubah');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $books = Book::find($id);

    $borrows = Borrow::where('book_id', $books->id)->where('status', 'Pinjam')->exists();
    if ($borrows) {
      return back()->with('error', 'Data Tidak Bisa Dihapus Karena Masih Ada Peminjaman');
    }

    // Hapus file lama
    if ($books->image) {
      File::delete('uploads/' . $books->image);
    }

    $books->delete();
    return redirect('/books')->with('success', 'Data Berhasil Dihapus');
  }
}
