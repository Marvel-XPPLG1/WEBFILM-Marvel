@extends('templates.index')

@section('content')
<div class="container" style="margin:30px auto;color:#fff;">
  <h3>Data Genre <a href="{{ route('admin.genres.create') }}" class="btn btn-primary pull-right">+ Tambah Genre</a></h3>
  <div class="table-responsive">
    <table class="table table-bordered" style="color:#fff;">
      <thead><tr><th>#</th><th>Nama</th><th>Jumlah Film</th><th width="170">Aksi</th></tr></thead>
      <tbody>
        @forelse ($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->films_count }}</td>
            <td>
              <a href="{{ route('admin.genres.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('admin.genres.destroy', $item->id) }}" method="post" style="display:inline;" onsubmit="return confirm('Hapus genre ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center">Belum ada data.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  {{ $items->links() }}
</div>
@endsection
