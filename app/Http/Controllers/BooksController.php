<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class BooksController extends Controller
{
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
    $request->validate([
      'title' => 'required',
      'summary' => 'required',
      'releas_year' => 'required',
      'category_id' => 'exists:categories,id',
      'image' => 'required|mimes:jpg,jpeg,png|max:2048'
    ]);
    // mengubah naman file jadi unique
    $newNameImage = time() . '.' . $request->image->extension();
    // tempat penyimpanan image
    $request->image->move(public_path('uploads'), $newNameImage);

    $books = new Book;

    $books->title = $request->input('title');
    $books->summary = $request->input('summary');
    $books->releas_year = $request->input('releas_year');
    $books->category_id = $request->input('category_id');
    $books->image = $newNameImage;

    $books->save();

    return redirect('/books');
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
    $request->validate([
      'title' => 'required',
      'summary' => 'required',
      'releas_year' => 'required',
      'category_id' => 'exists:categories,id',
      'image' => 'mimes:jpg,jpeg,png|max:2048'
    ]);

    $books = Book::find($id);

    if ($request->has('image')) {
      // Hapus file lama
      File::delete('uploads/' . $books->image);
      // mengubah naman file jadi unique
      $newNameImage = time() . '.' . $request->image->extension();
      // tempat penyimpanan image
      $request->image->move(public_path('uploads'), $newNameImage);

      $books->image = $newNameImage;
    }

    $books->title = $request->input('title');
    $books->summary = $request->input('summary');
    $books->releas_year = $request->input('releas_year');
    $books->category_id = $request->input('category_id');

    $books->save();

    return redirect('/books');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $books = Book::find($id);
    // Hapus file lama
    if ($books->image) {
      File::delete('uploads/' . $books->image);
    }

    $books->delete();
    return redirect('/books');
  }
}
