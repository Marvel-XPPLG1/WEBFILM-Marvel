@extends('templates.index')

@section('content')
<div class="container" style="margin:30px auto;color:#fff;">
  <h3>Profile Saya <small style="color:#ccc;">({{ $user->role->name ?? '-' }})</small></h3>
  <form action="{{ route('profile.update') }}" method="post" style="max-width:600px;">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label>Nama</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>
    <div class="form-group">
      <label>Umur</label>
      <input type="number" name="umur" class="form-control" value="{{ old('umur', $user->profile->umur ?? 0) }}" required>
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <textarea name="alamat" rows="3" class="form-control">{{ old('alamat', $user->profile->alamat ?? '') }}</textarea>
    </div>
    <div class="form-group">
      <label>Bio</label>
      <textarea name="bio" rows="3" class="form-control">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
    </div>
    <hr>
    <p>Kosongkan password jika tidak ingin diganti.</p>
    <div class="form-group">
      <label>Password Baru</label>
      <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
      <label>Konfirmasi Password</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>
    <button class="btn btn-primary">Simpan Perubahan</button>
  </form>
</div>
@endsection
