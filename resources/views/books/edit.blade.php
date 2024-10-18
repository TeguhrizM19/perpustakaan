@extends('layouts.master')
@section('title')
  Tambah Buku
@endsection

@section('content')
<div class="row">
  <div class="col-md-8">
    <form action="/books/{{ $book->id }}" method="POST" enctype="multipart/form-data">
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
        <label>Judul</label>
        <input type="text" class="form-control" name="title" value="{{ $book->title }}">
      </div>
      <div class="form-group">
        <label>Ringkasan</label><br>
        <textarea name="summary" class="form-control" id="" cols="15" rows="5">{{ $book->summary }}</textarea>
      </div>
      <div class="form-group">
        <label>Tahun Rilis</label>
        <input type="date" class="form-control" name="releas_year" value="{{ $book->releas_year }}">
      </div>
      <div class="form-group">
        <label>Category</label>
        <select name="category_id" class="form-control" id="">
          <option value="">Pilih Category</option>
          @forelse ($categories as $category)
            @if ($category->id === $book->category_id)
              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
          @empty
            <option value="">Category masih kosong</option>
          @endforelse
        </select>
      </div>
      <div class="form-group">
        <label>Image</label>
        <input type="file" class="form-control" name="image">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

@endsection