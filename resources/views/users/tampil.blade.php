@extends('layouts.master')
@section('title')
  Daftar Users
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
<table class="table" id="example1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($users as $user)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          @auth
          <form action="/users/{{ $user->id }}" method="POST">
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fas fa-solid fa-ban"></i></button>
          </form>
          @endauth
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