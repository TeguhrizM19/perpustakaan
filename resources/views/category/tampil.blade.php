@extends('layouts.master')
@section('title')
  Tampil Kategori
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
<a href="/category/create" class="btn btn-info mb-3"><i class="fas fa-solid fa-plus"></i>  Tambah Kategori</a>
@endauth

<table class="table" id="example1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($categories as $category)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $category->name }}</td>
        <td>
          <form action="/category/{{ $category->id }}" method="POST">
          <a href="/category/{{ $category->id }}" class="btn btn-success"><i class="fas fa-solid fa-eye"></i></a>
          @auth
            <a href="/category/{{ $category->id }}/edit" class="btn btn-warning"><i class="fas fa-solid fa-pen-nib"></i></a>
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