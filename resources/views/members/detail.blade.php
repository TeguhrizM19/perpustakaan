@extends('layouts.master')
@section('title')
  Detail Anggota
@endsection

@section('content')
<h4 class="mb-3">Bio Data Anggota : {{ $member->nama }}</h4>
<div class="row">
  <div class="col">
    <div class="card">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Nama : {{ $member->nama }}</li>
        <li class="list-group-item">Alamat : {{ $member->alamat }}</li>
        <li class="list-group-item">No Telpon : {{ $member->no_telpon }}</li>
        <li class="list-group-item">Email : {{ $member->email }}</li>
      </ul>
    </div>
  </div>

  <div class="col">
    <div class="card">
      <img src="{{ asset('foto/' . $member->image) }}" width="200px" alt="">
    </div>
  </div>
</div>

<a href="/members" class="btn btn-warning mt-3">Kembali</a>
@endsection