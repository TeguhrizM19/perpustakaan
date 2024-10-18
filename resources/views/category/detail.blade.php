@extends('layouts.master')
@section('title')
  Detail Kategori
@endsection

@section('content')
<a href="/category" class="btn btn-primary">Kembali</a>
<h1>{{ $category->name }}</h1>
{{-- @forelse ($category->books as $book)
<ul>
  <li>{{ $book->title }}</li>
</ul>
@empty
  <ul>
    <li>Data tidak ditemukan</li>
  </ul>
@endforelse --}}

@endsection