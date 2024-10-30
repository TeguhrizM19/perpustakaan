@extends('layouts.master')
@section('title')
  Cetak Kartu
@endsection

@section('content')
<style>
  .ktp {
    width: 3.37in;
    height: 2.12in;
  }

  .ktp ul {
    font-size: 12px;
  }
</style>
<div class="card ktp mb-3">
  <h6 class="mt-3 text-center">Kartu Anggota Perpustakaan</h6><hr>
  <div class="row no-gutters ml-2">
    <div class="col-md-4">
      <img src="{{ asset('foto/' . $member->image) }}" alt="Foto Member" width="100px">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <ul class="list-group list-group-flush list-unstyled">
          <li>Nama : {{ $member->nama }}</li>
          <li>Alamat : {{ $member->alamat }}</li>
          <li>No Telpon : {{ $member->no_telpon }}</li>
          <li>Email : {{ $member->email }}</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <a href="/members" class="btn btn-warning mt-3">Kembali</a>
  </div>
</div>
@endsection
