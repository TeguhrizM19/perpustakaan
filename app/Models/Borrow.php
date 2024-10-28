<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use App\Models\Member;
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
    return $this->belongsTo(User::class);
  }

  public function book()
  {
    // Relasi Many to One, Banyak peminjaman bisa meminjam satu buku
    return $this->belongsTo(Book::class, 'book_id');
  }

  public function member()
  {
    // Relasi Many to One, Banyak peminjaman bisa dilakukan satu member
    return $this->belongsTo(Member::class);
  }

  public function terlambat()
  {
    // Jika status sudah "Kembali", tidak ada keterlambatan
    if ($this->status == 'Kembali') {
      return $this->terlambat ?? 0;
    }

    $tanggalKembali = strtotime($this->tgl_kembali);
    $tanggalSekarang = strtotime(now()->format('Y-m-d'));

    // Hitung selisih dalam hari
    $selisih = ($tanggalSekarang - $tanggalKembali) / 86400;

    // Jika terlambat, simpan nilai keterlambatan ke kolom 'keterlambatan_hari' sebelum update status menjadi 'Kembali'
    $this->terlambat = $selisih > 0 ? floor($selisih) : 0;
    $this->save();

    return $this->terlambat;
  }
}
