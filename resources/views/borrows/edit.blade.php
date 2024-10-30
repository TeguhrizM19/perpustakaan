@extends('layouts.master')
@section('title')
  Edit Peminjaman
@endsection

@section('content')
<div class="row">
  <div class="col-md-8">
    <form action="/borrows/{{ $borrow->id }}" method="POST">
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
      @method("PUT")
      @csrf
      <div class="form-group">
        <label>Tanggal Pinjam</label>
        <input type="text" class="form-control" name="tgl_peminjaman" value="{{ $borrow->tgl_peminjaman }}" readonly>
      </div>
      <div class="form-group">
        <label>Tanggal Kembali</label>
        <input type="text" class="form-control" name="tgl_kembali" value="{{ $borrow->tgl_kembali }}" readonly>
      </div>
      <div class="form-group">
        <label>Peminjam</label>
        <select name="member_id" class="form-control select2">
          <option value="">Pilih Peminjam</option>
          @forelse ($members as $member)
            @if ($member->id == $borrow->member_id)
              <option value="{{ $member->id }}" selected>{{ $member->nama }}</option>
            @else
              <option value="{{ $member->id }}">{{ $member->nama }}</option>
            @endif
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
            @if ($book->id == $borrow->book_id)
              <option value="{{ $book->id }}" selected>{{ $book->title }}</option>
            @else
              <option value="{{ $book->id }}">{{ $book->title }}</option>
            @endif
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
{{-- Push JS Select2 ke stack 'scripts' --}}
@push('scripts')
<script src="{{ asset('templating/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2({
      placeholder: "Pilih Opsi",
      theme: 'bootstrap4'
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
