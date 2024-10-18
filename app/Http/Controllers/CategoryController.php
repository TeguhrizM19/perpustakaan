<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $categories = Category::all();
    return view('category.tampil', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('category.tambah');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|min:2'
    ]);

    $categories = new Category;
    $categories->name = $request->input('name');

    $categories->save();
    return redirect('/category');
  }

  /**
   * Display the specified resource.
   */
  public function show(String $id)
  {
    $category = Category::find($id);
    return view('category.detail', compact('category'));;
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(String $id)
  {
    $category = Category::find($id);
    return view('category.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, String $id)
  {
    $request->validate([
      'name' => 'required|min:2'
    ]);

    $categories = Category::find($id);

    $categories->name = $request->input('name');

    $categories->save();
    return redirect('/category');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(String $id)
  {
    $categories = Category::find($id);

    $categories->delete();
    return redirect('/category');
  }
}
