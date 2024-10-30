@extends('layouts.master')
@section('title')
  Cetak Kartu
@endsection

@section('content')
<style>
  .ktp {
    width: 3.37in;
    height: 2.12in;
    border: 1px solid black;
    padding: 0px;
    margin: 0px;
  }

  hr {
    border-bottom: 1px solid black;
  }

  .ktp ul {
    font-size: 12px;
    padding: 0;
    margin: 0;
  }

  @media print {
    .no-print {
      display: none;
    }
  }
</style>
<div class="card ktp mb-3">
  <h6 class="mt-3 text-center garis">Kartu Anggota Perpustakaan</h6><hr>
  <div class="row justify-content-between">
    <div class="col ml-4 p-0">
      <ul class="list-group list-group-flush list-unstyled">
        <li>Nama : {{ $member->nama }}</li>
        <li>Alamat : {{ $member->alamat }}</li>
        <li>No Telpon : {{ $member->no_telpon }}</li>
        <li>Email : {{ $member->email }}</li>
      </ul>
    </div>
    <div class="col mr-4 p-0">
      <img src="{{ asset('foto/' . $member->image) }}" class="ml-5" alt="Foto Member" width="100px">
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <a href="/members" class="btn btn-warning no-print">Kembali</a>
    <button onclick="window.print()" class="btn btn-info no-print"><i class="fas fa-solid fa-print"></i> Cetak Kartu</button>
  </div>
</div>
@endsection
