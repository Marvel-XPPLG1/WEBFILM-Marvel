@extends('templates.index')

@section('content')
<div class="container" style="margin:30px auto;color:#fff;">
  <h3>{{ $item->exists ? 'Edit' : 'Tambah' }} Cast</h3>
  <form action="{{ $item->exists ? route('admin.casts.update', $item->id) : route('admin.casts.store') }}" method="post" style="max-width:600px;">
    @csrf
    @if ($item->exists) @method('PUT') @endif
    <div class="form-group">
      <label>Nama</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" required>
    </div>
    <div class="form-group">
      <label>Umur</label>
      <input type="number" name="age" class="form-control" value="{{ old('age', $item->age) }}" required>
    </div>
    <div class="form-group">
      <label>Bio</label>
      <textarea name="bio" rows="4" class="form-control" required>{{ old('bio', $item->bio) }}</textarea>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.casts.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection
