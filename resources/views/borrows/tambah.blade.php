@extends('layouts.master')
@section('title')
  Tambah kategori
@endsection

{{-- Push CSS Select2 ke stack 'styles' --}}
@push('styles')
  <link href="{{ asset('templating/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('templating/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<?php 
$pinjam = date('d-M-Y');
$kembali =date('d-M-Y', strtotime('+14 days', strtotime($pinjam)));
?>
<div class="row">
  <div class="col-md-8">
    <form action="/borrows" method="POST">
      {{-- Validasi jika stock buku habis --}}
    @if(session()->has('pesan'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('pesan') }}
    </div>
    @endif

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
        <select name="member_id" class="form-control opsi">
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
        <select name="book_id" class="form-control opsi">
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

{{-- Push JS Select2 ke stack 'scripts' --}}
@push('scripts')
<script src="{{ asset('templating/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $('.opsi').select2({
      placeholder: "Pilih Opsi",
      theme: 'bootstrap4'
    });
  });
</script>
@endpush
