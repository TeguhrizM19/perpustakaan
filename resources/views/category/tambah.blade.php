@extends('layouts.master')
@section('title')
  Tambah kategori
@endsection

@section('content')
<form action="/category" method="POST">
  <div class="row">
    <div class="col-md-8">
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
        <label>Category Name</label>
        <input type="text" class="form-control" name="name">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
@endsection