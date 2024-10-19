@extends('layouts.master')
@section('title')
  Detail Buku
@endsection

@section('content')
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title font-weight-bold">Judul : {{ $book->title }}</h4><br>
        <ul>
          <li>Ringkasan : {{ $book->summary }}</li>
          <li>Tahun Rilis : {{ $book->releas_year }}</li>
          <li>Kategori : {{ $book->category->name }}</li>
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

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <table class="table">
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