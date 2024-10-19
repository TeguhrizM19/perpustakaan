@extends('layouts.master')
@section('title')
  Halaman Peminjaman
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
<a href="/borrows/create" class="btn btn-info mb-3">
  <i class="fas fa-solid fa-plus"></i>  
  Tambah Peminjaman
</a>
@endauth

<table class="table" id="example1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Peminjam</th>
      <th scope="col">Buku</th>
      <th scope="col">Tanggal Pinjam</th>
      <th scope="col">Tanggal Kembali</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($borrows as $borrow)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $borrow->user->name }}</td>
        <td>{{ $borrow->book->title }}</td>
        <td>{{ $borrow->tgl_peminjaman }}</td>
        <td>{{ $borrow->tgl_kembali }}</td>
        <td>
          @auth
          <form action="/borrow/{{ $borrow->id }}" method="POST">
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fas fa-solid fa-ban"></i></button>
          </form>
          @endauth
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