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
      @if ($book->image)
        <img src="{{ asset('uploads/' . $book->image) }}" width="200px">
      @else
        <svg height="200" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="m30 3.4141-1.4141-1.4141-26.5859 26.5859 1.4141 1.4141 2-2h20.5859a2.0027 2.0027 0 0 0 2-2v-20.5859zm-4 22.5859h-18.5859l7.7929-7.793 2.3788 2.3787a2 2 0 0 0 2.8284 0l1.5858-1.5857 4 3.9973zm0-5.8318-2.5858-2.5859a2 2 0 0 0 -2.8284 0l-1.5858 1.5859-2.377-2.3771 9.377-9.377z"/><path d="m6 22v-3l5-4.9966 1.3733 1.3733 1.4159-1.416-1.375-1.375a2 2 0 0 0 -2.8284 0l-3.5858 3.5859v-10.1716h16v-2h-16a2.002 2.002 0 0 0 -2 2v16z"/><path d="m0 0h32v32h-32z" fill="none"/></svg>
      @endif
    </div>
  </div>
</div>

<a href="/books" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
@endsection