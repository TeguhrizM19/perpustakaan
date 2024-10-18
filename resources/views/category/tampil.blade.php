@extends('layouts.master')
@section('title')
  Tampil Kategori
@endsection

@section('content')
<a href="/category/create" class="btn btn-info"><i class="fas fa-solid fa-plus"></i>  Tambah</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($categories as $category)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $category->name }}</td>
        <td>
          <form action="/category/{{ $category->id }}" method="POST">
          <a href="/category/{{ $category->id }}" class="btn btn-success"><i class="fas fa-solid fa-eye"></i></a>
          <a href="/category/{{ $category->id }}/edit" class="btn btn-warning"><i class="fas fa-solid fa-pen-nib"></i></a>
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