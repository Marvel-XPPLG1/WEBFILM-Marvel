<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $items = Genre::withCount('films')->orderBy('id')->paginate(20);

        return view('admin.genres.index', compact('items'));
    }

    public function create()
    {
        return view('admin.genres.form', ['item' => new Genre()]);
    }

    public function store(Request $request)
    {
        Genre::create($request->validate(['name' => 'required|string|max:45']));

        return redirect()->route('admin.genres.index')->with('success', 'Genre ditambahkan.');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.form', ['item' => $genre]);
    }

    public function update(Request $request, Genre $genre)
    {
        $genre->update($request->validate(['name' => 'required|string|max:45']));

        return redirect()->route('admin.genres.index')->with('success', 'Genre diperbarui.');
    }

    public function destroy(Genre $genre)
    {
        if ($genre->films()->exists()) {
            return back()->with('error', 'Genre masih dipakai oleh film, tidak bisa dihapus.');
        }
        $genre->delete();

        return redirect()->route('admin.genres.index')->with('success', 'Genre dihapus.');
    }
}
