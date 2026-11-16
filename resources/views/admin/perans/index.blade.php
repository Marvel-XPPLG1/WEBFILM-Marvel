@extends('templates.index')

@section('content')
<div class="container" style="margin:30px auto;color:#fff;">
  <h3>Data Peran <a href="{{ route('admin.perans.create') }}" class="btn btn-primary pull-right">+ Tambah Peran</a></h3>
  <div class="table-responsive">
    <table class="table table-bordered" style="color:#fff;">
      <thead><tr><th>#</th><th>Film</th><th>Cast</th><th>Peran</th><th width="170">Aksi</th></tr></thead>
      <tbody>
        @forelse ($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->film->title ?? '-' }}</td>
            <td>{{ $item->cast->name ?? '-' }}</td>
            <td>{{ $item->actor }}</td>
            <td>
              <a href="{{ route('admin.perans.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('admin.perans.destroy', $item->id) }}" method="post" style="display:inline;" onsubmit="return confirm('Hapus peran ini?')">
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
