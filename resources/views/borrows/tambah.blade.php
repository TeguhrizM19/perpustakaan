@extends('layouts.master')
@section('title')
  Tambah kategori
@endsection

@section('content')
<?php 
$pinjam = date('d-M-Y');
$kembali =date('d-M-Y', strtotime('+14 days', strtotime($pinjam)));
?>
<div class="row">
  <div class="col-md-8">
    <form action="/borrows" method="POST">
      {{-- Validation jika tdk diinputkan --}}
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      {{-- Input form --}}
      @csrf
      <div class="form-group">
        <label>Peminjam</label>
        <select name="user_id" class="form-control">
          <option value="">Pilih Peminjam</option>
          @forelse ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
          @empty
            Data masih kosong
          @endforelse
        </select>
      </div>
      <div class="form-group">
        <label>Buku</label>
        <select name="book_id" class="form-control">
          <option>Pilih Buku</option>
          @forelse ($books as $book)
            <option value="{{ $book->id }}">{{ $book->title }}</option>
          @empty
            Data masih kosong
          @endforelse
        </select>
      </div>
      <div class="form-group">
        <label>Tanggal Pinjam</label>
        <input type="text" class="form-control" name="tgl_peminjaman" value="{{ $pinjam }}" readonly>
      </div>
      <div class="form-group">
        <label>Tanggal Kembali</label>
        <input type="text" class="form-control" name="tgl_kembali" value="{{ $kembali }}" readonly>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
@endsection