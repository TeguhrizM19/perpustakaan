@extends('layouts.master')
@section('title')
  Tampil Kategori
@endsection

@section('content')
@auth
<a href="/books/create" class="btn btn-info"><i class="fas fa-solid fa-plus"></i>  Tambah</a>
@endauth

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Summary</th>
      <th scope="col">Tahun Rilis</th>
      <th scope="col">Kategori</th>
      <th scope="col">Gambar</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($books as $book)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $book->title }}</td>
        <td>{{ $book->summary }}</td>
        <td>{{ $book->releas_year }}</td>
        <td>{{ $book->category->name }}</td>
        <td>
          <img src="{{ asset('uploads/' . $book->image) }}" width="80px" alt="">
        </td>
        <td>
          <form action="/books/{{ $book->id }}" method="POST">
          <a href="/books/{{ $book->id }}" class="btn btn-success"><i class="fas fa-solid fa-eye"></i></a>
          @auth
            <a href="/books/{{ $book->id }}/edit" class="btn btn-warning"><i class="fas fa-solid fa-pen-nib"></i></a>
          @method("DELETE")
          @csrf
            <button type="submit" class="btn btn-danger"><i class="fas fa-solid fa-ban"></i></button>
          @endauth
          </form>
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