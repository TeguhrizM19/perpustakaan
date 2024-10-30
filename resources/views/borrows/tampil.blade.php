@extends('layouts.master')
@section('title')
  Halaman Peminjaman
@endsection

@section('content')
<a href="/borrows/create" class="btn btn-info mb-3">
  <i class="fa-solid fa-circle-plus"></i>  Tambah Peminjaman
</a>
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
          @auth
          @if ($borrow->status == 'Pinjam')
          <form action="/borrows/{{ $borrow->id }}/selesai" method="POST" class="d-inline">
            @method("PUT")
            @csrf
            <button type="submit" class="btn btn-success end-button">Selesai</button>
          </form>
          @endif
          @if ($borrow->status == 'Kembali')
            <button type="submit" class="btn btn-warning errorEdit"><i class="fas fa-solid fa-pen-nib"></i></button>
          @else
            <a href="/borrows/{{ $borrow->id }}/edit" class="btn btn-warning"><i class="fas fa-solid fa-pen-nib"></i></a>
          @endif
          <form action="/borrows/{{ $borrow->id }}" method="POST" class="d-inline">
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger delete-button"><i class="fas fa-solid fa-ban"></i></button>
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

{{-- Library JS Alert Sweetalert (Tdk bisa diedit) --}}
@push('scripts')
<script>
  document.querySelectorAll('.errorEdit').forEach(function(button) {
  button.addEventListener('click', function(event) {
    // Tampilkan konfirmasi SweetAlert
    Swal.fire({
      icon: 'error',
      title: 'Tidak Dapat Diedit',
      text: "Status Peminjaman Sudah 'Kembali' Dan Tidak Dapat Diedit",
      confirmButtonText: 'OK',
    })
  });
});
</script>
@endpush
{{-- Library JS Alert Sweetalert (Error) --}}
@if(session('error'))
  @push('scripts')
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Gagal',
      text: "{{ session('error') }}",
      confirmButtonText: 'OK'
    });
  </script>
  @endpush
@endif
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

{{-- Library JS Alert Sweetalert (konfirmasi Selesai) --}}
@push('scripts')
<script>
  // Pilih semua tombol delete dan tambahkan event listener
  document.querySelectorAll('.end-button').forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault(); // Mencegah submit form default
      // Tampilkan konfirmasi SweetAlert
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Peminjaman selesai!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, selesai!',
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