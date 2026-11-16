@extends('templates.index')

@section('content')
<div class="container" style="margin:30px auto;color:#fff;">
  <h3>{{ $item->exists ? 'Edit' : 'Tambah' }} Peran</h3>
  <form action="{{ $item->exists ? route('admin.perans.update', $item->id) : route('admin.perans.store') }}" method="post" style="max-width:600px;">
    @csrf
    @if ($item->exists) @method('PUT') @endif
    <div class="form-group">
      <label>Film</label>
      <select name="film_id" class="form-control" required>
        <option value="">-- Pilih Film --</option>
        @foreach ($films as $f)
          <option value="{{ $f->id }}" {{ old('film_id', $item->film_id) == $f->id ? 'selected' : '' }}>{{ $f->title }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Cast</label>
      <select name="cast_id" class="form-control" required>
        <option value="">-- Pilih Cast --</option>
        @foreach ($casts as $c)
          <option value="{{ $c->id }}" {{ old('cast_id', $item->cast_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Nama Peran</label>
      <input type="text" name="actor" class="form-control" value="{{ old('actor', $item->actor) }}" required>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.perans.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection
