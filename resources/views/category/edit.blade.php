@extends('layouts.master')
@section('title')
  Edit kategori
@endsection

@section('content')
<form action="/category/{{ $category->id }}" method="POST">
  {{-- Validation jika tdk diinputkan --}}
  @method("PUT")
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
    <input type="text" class="form-control" name="name" value="{{ $category->name }}">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection