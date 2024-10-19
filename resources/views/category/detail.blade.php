@extends('layouts.master')
@section('title')
  Detail Kategori
@endsection

@section('content')
<h3 class="text-center">Daftar Buku Category : {{ $category->name }}</h3>
<a href="/category" class="btn btn-primary my-3">Kembali</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Tahun Rilis</th>
      <th scope="col">Kategori</th>
      <th scope="col">Gambar</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($category->books as $book)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $book->title }}</td>
        <td>{{ $book->releas_year }}</td>
        <td>{{ $book->category->name }}</td>
        <td>
          <img src="{{ asset('uploads/' . $book->image) }}" width="80px" alt="">
        </td>
        <td>
          <a href="/books/{{ $book->id }}" class="btn btn-success"><i class="fas fa-solid fa-eye"></i></a>
        </td>
      </tr>
    @empty
      <tr>
        <td>Data Masih Kosong</td>
      </tr>
    @endforelse
    
  </tbody>
</table>
@endsection