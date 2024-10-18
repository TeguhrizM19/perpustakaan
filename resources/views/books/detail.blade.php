@extends('layouts.master')
@section('title')
  Detail Buku
@endsection

@section('content')
<ul>
  <li>Judul : {{ $book->title }}</li>
  <li>Ringkasan : {{ $book->summary }}</li>
  <li>Tahun Rilis : {{ $book->releas_year }}</li>
  <li>Kategori : {{ $book->category->name }}</li>
  <li>
    <img src="{{ asset('uploads/' . $book->image) }}" width="80px" alt="" class="my-3">
  </li>
</ul>
<a href="/books" class="btn btn-primary">Kembali</a>
@endsection