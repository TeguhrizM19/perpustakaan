@extends('layouts.master')
@section('title')
  Halaman Anggota
@endsection

@section('content')
<a href="/members/create" class="btn btn-info">
  <i class="fas fa-solid fa-plus"></i>  
  Tambah Anggota
</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">No Telpon</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($members as $member)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $member->nama }}</td>
        <td>{{ $member->alamat }}</td>
        <td>{{ $member->no_telpon }}</td>
        <td>{{ $member->email }}</td>
        <td>
          <form action="/members/{{ $member->id }}" method="POST">
          <a href="/members/{{ $member->id }}" class="btn btn-success"><i class="fas fa-solid fa-eye"></i></a>
          <a href="/members/{{ $member->id }}/edit" class="btn btn-warning"><i class="fas fa-solid fa-pen-nib"></i></a>
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