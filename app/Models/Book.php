<?php

namespace App\Models;

use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
  use HasFactory;

  protected $table = 'books';
  protected $fillable = ['title', 'summary', 'releas_year', 'category_id '];

  public function category()
  {
    // Relasi Many to One, setiap buku memiliki satu category
    return $this->belongsTo(Category::class);
  }

  public function borrows()
  {
    // Relasi One to Many, Satu buku bisa dipinjam di banyak transaksi peminjaman
    return $this->hasMany(Borrow::class, 'book_id');
  }
}
