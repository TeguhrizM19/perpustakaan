@extends('layouts.master')
@section('title')
  Halaman Buku
@endsection

@push('scripts')
<script src="{{ asset('templating/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('templating/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable('');
  });
</script>
@endpush
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
@endpush

@section('content')
@auth
<a href="/books/create" class="btn btn-info mb-3"><i class="fas fa-solid fa-plus"></i>  Tambah Buku</a>
@endauth
<table class="table" id="example1">
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
    @forelse ($books as $book)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $book->title }}</td>
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