@extends('layouts.master')
@section('title')
  Detail Buku
@endsection

@section('content')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-header">
        <h5 class="font-weight-bold">Judul : {{ $book->title }}</h5>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Ringkasan : {{ $book->summary }}</li>
        <li class="list-group-item">Tahun Rilis : {{ $book->releas_year }}</li>
        <li class="list-group-item">Kategori : {{ $book->category->name }}</li>
        <li class="list-group-item">Stock Buku : {{ $book->stock }}</li>
      </ul>
    </div>
  </div>

  <div class="col">
    <div class="card">
      <img src="{{ asset('uploads/' . $book->image) }}" width="200px" alt=""">
    </div>
  </div>
</div>

<a href="/books" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
@endsection