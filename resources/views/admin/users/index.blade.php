@extends('templates.index')

@section('content')
<div class="container" style="margin:30px auto;color:#fff;">
  <h3>List Data User</h3>
  <div class="table-responsive">
    <table class="table table-bordered" style="color:#fff;">
      <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Umur</th><th>Alamat</th><th>Bio</th></tr></thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->name ?? '-' }}</td>
            <td>{{ $user->profile->umur ?? '-' }}</td>
            <td>{{ $user->profile->alamat ?? '-' }}</td>
            <td>{{ $user->profile->bio ?? '-' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{ $users->links() }}
</div>
@endsection
