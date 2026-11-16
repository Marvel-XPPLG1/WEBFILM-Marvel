@extends('templates.index')

@section('content')
<div class="container" style="margin:30px auto;color:#fff;">
  <h3>{{ $item->exists ? 'Edit' : 'Tambah' }} Film</h3>
  <form action="{{ $item->exists ? route('admin.films.update', $item->id) : route('admin.films.store') }}" method="post" enctype="multipart/form-data" style="max-width:600px;">
    @csrf
    @if ($item->exists) @method('PUT') @endif
    <div class="form-group">
      <label>Judul</label>
      <input type="text" name="title" class="form-control" value="{{ old('title', $item->title) }}" required>
    </div>
    <div class="form-group">
      <label>Sinopsis</label>
      <textarea name="sinopsis" rows="5" class="form-control" required>{{ old('sinopsis', $item->sinopsis) }}</textarea>
    </div>
    <div class="form-group">
      <label>Tahun</label>
      <input type="number" name="year" class="form-control" value="{{ old('year', $item->year) }}" required>
    </div>
    <div class="form-group">
      <label>Genre</label>
      <select name="genre_id" class="form-control" required>
        <option value="">-- Pilih Genre --</option>
        @foreach ($genres as $g)
          <option value="{{ $g->id }}" {{ old('genre_id', $item->genre_id) == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Poster {{ $item->exists ? '(kosongkan jika tidak diganti)' : '' }}</label>
      @if ($item->exists)
        <div><img src="{{ asset($item->poster) }}" alt="" style="height:100px;margin-bottom:8px;"></div>
      @endif
      <input type="file" name="poster" class="form-control" {{ $item->exists ? '' : 'required' }}>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.films.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection
