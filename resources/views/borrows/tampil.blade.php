@extends('layouts.master')
@section('title')
  Halaman Peminjaman
@endsection

@push('scripts')
  <script src="{{ asset('templating/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('templating/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <script>
    $(function() {
      $("#example1").DataTable();
    });
  </script>
@endpush

@section('content')
<a href="/borrows/create" class="btn btn-info mb-3">
  <i class="fa-solid fa-circle-plus"></i>  Tambah Peminjaman
</a>

@if(session()->has('status'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('status') }}
  </div>
@endif

<table class="table" id="example1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Peminjam</th>
      <th scope="col">Buku</th>
      <th scope="col">Tanggal Pinjam</th>
      <th scope="col">Tanggal Kembali</th>
      <th scope="col">Terlambat</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($borrows as $borrow)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $borrow->member->nama }}</td>
        <td>{{ $borrow->book->title }}</td>
        <td>{{ $borrow->tgl_peminjaman }}</td>
        <td>{{ $borrow->tgl_kembali }}</td>
        <td>
          @php
            $hariTerlambat = $borrow->terlambat();
          @endphp
          @if ($hariTerlambat > 0)
              <span style="color: red;">{{ $hariTerlambat }} hari</span>
          @else
              0 hari
          @endif
        </td>
        <td>{{ $borrow->status }}</td>
        <td>
          @if ($borrow->status == 'Pinjam')
          <form action="/borrows/{{ $borrow->id }}/selesai" method="POST" class="d-inline">
            @method("PUT")
            @csrf
            <button type="submit" class="btn btn-success">Selesai</button>
          </form>
          @endif
          <form action="/borrows/{{ $borrow->id }}" method="POST" class="d-inline">
          <a href="/borrows/{{ $borrow->id }}/edit" class="btn btn-warning"><i class="fas fa-solid fa-pen-nib"></i></a>
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

@push('styles')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush