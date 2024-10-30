@extends('layouts.master')
@section('title')
  Tambah Peminjaman
@endsection

@section('content')
<?php 
$pinjam = date('d-M-Y');
$kembali =date('d-M-Y', strtotime('+14 days', strtotime($pinjam)));
?>
<div class="row">
  <div class="col-md-8">
    <form action="/borrows" method="POST">
      {{-- Validation jika tdk diinputkan --}}
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      
      {{-- Input form --}}
      @csrf
      <div class="form-group">
        <label>Tanggal Pinjam</label>
        <input type="text" class="form-control" name="tgl_peminjaman" value="{{ $pinjam }}" readonly>
      </div>
      <div class="form-group">
        <label>Tanggal Kembali</label>
        <input type="text" class="form-control" name="tgl_kembali" value="{{ $kembali }}" readonly>
      </div>
      <div class="form-group">
        <label>Peminjam</label>
        <select name="member_id" class="form-control select2">
          <option value="">Pilih Peminjam</option>
          @forelse ($members as $member)
            <option value="{{ $member->id }}">{{ $member->nama }}</option>
          @empty
            Data masih kosong
          @endforelse
        </select>
      </div>
      <div class="form-group">
        <label>Buku</label>
        <select name="book_id" class="form-control select2">
          <option value="">Pilih Buku</option>
          @forelse ($books as $book)
            <option value="{{ $book->id }}">{{ $book->title }}</option>
          @empty
            Data masih kosong
          @endforelse
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
@endsection

{{-- Link Library Select2 (dropdown) --}}
@push('styles')
  <link href="{{ asset('templating/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('templating/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
<style>
  /* Agar dropdown tidak terlalu panjang */
  .select2-dropdown {
    max-height: 150px; /* Sesuaikan sesuai kebutuhan */
    overflow-y: auto;
  }
</style>
<script src="{{ asset('templating/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2({
      placeholder: "Pilih Opsi",
      theme: 'bootstrap4',
      dropdownCssClass: 'select2-dropdown'
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
