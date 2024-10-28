@extends('layouts.master')
@section('title')
  Detail Kategori
@endsection

@section('content')
<h3 class="mb-3 text-center font-weight-bold">Halaman Category : {{ $category->name }}</h3>

<h4 class="mb-3">Daftar Buku</h4>
<table class="table" id="example1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Tahun Rilis</th>
      <th scope="col">Stock</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($category->books as $book)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $book->title }}</td>
        <td>{{ $book->releas_year }}</td>
        <td>{{ $book->stock }}</td>
      </tr>
    @empty
      <tr>
        <td>Data Masih Kosong</td>
      </tr>
    @endforelse
  </tbody>
</table>

<a href="/category" class="btn btn-primary mt-3">Kembali</a>

@endsection