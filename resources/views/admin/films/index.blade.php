@extends('templates.index')

@section('content')
<div class="container" style="margin:30px auto;color:#fff;">
  <h3>Data Film <a href="{{ route('admin.films.create') }}" class="btn btn-primary pull-right">+ Tambah Film</a></h3>
  <div class="table-responsive">
    <table class="table table-bordered" style="color:#fff;">
      <thead><tr><th>#</th><th>Poster</th><th>Judul</th><th>Tahun</th><th>Genre</th><th width="170">Aksi</th></tr></thead>
      <tbody>
        @forelse ($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td><img src="{{ asset($item->poster) }}" alt="" style="height:60px;"></td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->year }}</td>
            <td>{{ $item->genre->name ?? '-' }}</td>
            <td>
              <a href="{{ route('admin.films.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('admin.films.destroy', $item->id) }}" method="post" style="display:inline;" onsubmit="return confirm('Hapus film ini beserta peran & komentarnya?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center">Belum ada data.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  {{ $items->links() }}
</div>
@endsection
