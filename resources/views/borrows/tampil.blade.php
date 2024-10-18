@extends('layouts.master')
@section('title')
  Halaman Peminjaman
@endsection

@section('content')
<a href="/borrows/create" class="btn btn-info">
  <i class="fas fa-solid fa-plus"></i>  
  Tambah Peminjaman
</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tanggal Pinjam</th>
      <th scope="col">Tanggal Kembali</th>
      <th scope="col">Peminjam</th>
      <th scope="col">Buku</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($borrows as $borrow)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $borrow->tgl_peminjaman }}</td>
        <td>{{ $borrow->tgl_kembali }}</td>
        <td>{{ $borrow->user->name }}</td>
        <td>{{ $borrow->book->title }}</td>
        <td>
          <form action="/borrow/{{ $borrow->id }}" method="POST">
          <a href="/borrow/{{ $borrow->id }}" class="btn btn-success"><i class="fas fa-solid fa-eye"></i></a>
          <a href="/borrow/{{ $borrow->id }}/edit" class="btn btn-warning"><i class="fas fa-solid fa-pen-nib"></i></a>
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fas fa-solid fa-ban"></i></button>
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