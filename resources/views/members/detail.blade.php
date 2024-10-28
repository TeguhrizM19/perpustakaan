@extends('layouts.master')
@section('title')
  Detail Anggota
@endsection

@section('content')
<h4>Bio Data Anggota : {{ $member->nama }}</h4>
<ul>
  <li>Nama : {{ $member->nama }}</li>
  <li>Alamat : {{ $member->alamat }}</li>
  <li>No Telpon : {{ $member->no_telpon }}</li>
  <li>Email : {{ $member->email }}</li>
  <li>
    <img src="{{ asset('foto/' . $member->image) }}" width="200px" alt="">
  </li>
</ul>
<a href="/members" class="btn btn-warning mt-3">Kembali</a>

@endsection