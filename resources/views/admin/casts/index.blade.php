@extends('templates.index')

@section('content')
<div class="container" style="margin:30px auto;color:#fff;">
  <h3>Data Cast <a href="{{ route('admin.casts.create') }}" class="btn btn-primary pull-right">+ Tambah Cast</a></h3>
  <div class="table-responsive">
    <table class="table table-bordered" style="color:#fff;">
      <thead><tr><th>#</th><th>Nama</th><th>Umur</th><th>Bio</th><th width="170">Aksi</th></tr></thead>
      <tbody>
        @forelse ($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->age }}</td>
            <td>{{ \Illuminate\Support\Str::limit($item->bio, 80) }}</td>
            <td>
              <a href="{{ route('admin.casts.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('admin.casts.destroy', $item->id) }}" method="post" style="display:inline;" onsubmit="return confirm('Hapus cast ini beserta perannya?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  {{ $items->links() }}
</div>
@endsection
