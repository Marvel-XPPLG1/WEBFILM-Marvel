@extends('templates.index')

@section('content')
<div class="container" style="margin:30px auto;color:#fff;">
  <h3>{{ $item->exists ? 'Edit' : 'Tambah' }} Genre</h3>
  <form action="{{ $item->exists ? route('admin.genres.update', $item->id) : route('admin.genres.store') }}" method="post" style="max-width:600px;">
    @csrf
    @if ($item->exists) @method('PUT') @endif
    <div class="form-group">
      <label>Nama Genre</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" required>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.genres.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection
