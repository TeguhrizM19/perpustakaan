<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrow extends Model
{
  use HasFactory;

  protected $table = 'borrows';
  protected $fillable = ['tgl_peminjaman', 'tgl_kembali', 'user_id', 'book_id'];

  public function user()
  {
    // Relasi Many to One, Banyak peminjaman bisa dilakukan satu user
    return $this->belongsTo(User::class, 'user_id');
  }

  public function book()
  {
    // Relasi Many to One, Banyak peminjaman bisa meminjam satu buku
    return $this->belongsTo(Book::class, 'book_id');
  }
}
