@extends('layouts.master')
@section('title')
  Tampil Kategori
@endsection

@section('content')
@auth
<a href="/category/create" class="btn btn-info mb-3">
  <i class="fa-solid fa-circle-plus"></i>  Tambah category</a>
@endauth

<table class="table" id="example1">
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
          <a href="/category/{{ $category->id }}" class="btn btn-success"><i class="fas fa-solid fa-eye"></i></a>
          @auth
          <a href="/category/{{ $category->id }}/edit" class="btn btn-warning"><i class="fas fa-solid fa-pen-nib"></i></a>
          <form action="/category/{{ $category->id }}" method="POST" class="d-inline">
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger delete-button"><i class="fas fa-solid fa-ban"></i></button>
          @endauth
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

{{-- Library JS Data Table --}}
@push('styles')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush

@push('scripts')
  <script src="{{ asset('templating/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('templating/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <script>
    $(function() {
      $("#example1").DataTable();
    });
  </script>
@endpush

{{-- Library JS Alert Sweetalert (Success) --}}
@if(session('success'))
  @push('scripts')
  <script>
    Swal.fire({
      position: "top-end",
      icon: "success",
      title: "Success",
      text: "{{ session('success') }}",
      showConfirmButton: false,
      timer: 2000
    });
  </script>
  @endpush
@endif
{{-- Library JS Alert Sweetalert (konfirmasi Hapus) --}}
@push('scripts')
<script>
  // Pilih semua tombol delete dan tambahkan event listener
  document.querySelectorAll('.delete-button').forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault(); // Mencegah submit form default
      // Tampilkan konfirmasi SweetAlert
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data ini akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Submit form jika pengguna menekan tombol "Ya, hapus!"
          button.closest('form').submit();
        }
      });
    });
  });
</script>
@endpush