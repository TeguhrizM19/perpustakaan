@extends('layouts.master')
@section('title')
  Detail Buku
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
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <div class="card-header">
          <h5 class="font-weight-bold">Judul : {{ $book->title }}</h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Ringkasan : {{ $book->summary }}</li>
          <li class="list-group-item">Tahun Rilis : {{ $book->releas_year }}</li>
          <li class="list-group-item">Kategori : {{ $book->category->name }}</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <img src="{{ asset('uploads/' . $book->image) }}" width="200px" alt="" class="my-3">
      </div>
    </div>
  </div>
</div>

<?php 
$pinjam = date('d-M-Y');
$kembali =date('d-M-Y', strtotime('+14 days', strtotime($pinjam)));
?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="font-weight-bold mb-3 text-center">Pinjam Buku</h5>
        @auth
        <form action="/borrow/{{ $book->id }}" method="POST">
          @csrf
          <div class="form-group">
            <label>Tanggal Pinjam</label>
            <input type="text" class="form-control" name="tgl_peminjaman" value="{{ $pinjam }}" readonly>
          </div>
          <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="text" class="form-control" name="tgl_kembali" value="{{ $kembali }}" readonly>
          </div>
          <input type="submit" value="Pinjam" class="btn btn-primary">
        </form>
        @endauth
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="font-weight-bold mb-3 text-center">Daftar Peminjaman</h5>
        <table class="table" id="example1">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Tanggal Pinjam</th>
              <th>Tanggal Kembali</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($book->borrows as $borrow)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $borrow->user->name }}</td>
              <td>{{ $borrow->tgl_peminjaman }}</td>
              <td>{{ $borrow->tgl_kembali }}</td>
            </tr>
            @empty
              data kosong
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection