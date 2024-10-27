@extends('layouts.master')
@section('title')
  Edit Anggota
@endsection

@section('content')
<div class="row">
  <div class="col-md-8">
    <form action="/members/{{ $member->id }}" method="POST">
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
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" value="{{ $member->nama }}">
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" id="" cols="10" rows="4">{{ $member->alamat }}</textarea>
      </div>
      <div class="form-group">
        <label>No Telpon</label>
        <input type="number" class="form-control" name="no_telpon" value="{{ $member->no_telpon }}">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" value="{{ $member->email }}">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
@endsection