<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('borrows', function (Blueprint $table) {
      $table->id();
      $table->string('tgl_peminjaman');
      $table->string('tgl_kembali');
      $table->unsignedBigInteger('member_id');
      $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
      $table->unsignedBigInteger('book_id');
      $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
      $table->integer('terlambat')->nullable()->default(0);
      $table->string('status')->default('Pinjam');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('borrows');
  }
};
