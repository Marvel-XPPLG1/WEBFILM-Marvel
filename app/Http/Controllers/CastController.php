<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    private function rules(): array
    {
        return [
            'name' => 'required|string|max:45',
            'age'  => 'required|integer|min:0|max:150',
            'bio'  => 'required|string',
        ];
    }

    public function index()
    {
        $items = Cast::orderBy('id')->paginate(15);

        return view('admin.casts.index', compact('items'));
    }

    public function create()
    {
        return view('admin.casts.form', ['item' => new Cast()]);
    }

    public function store(Request $request)
    {
        Cast::create($request->validate($this->rules()));

        return redirect()->route('admin.casts.index')->with('success', 'Cast ditambahkan.');
    }

    public function edit(Cast $cast)
    {
        return view('admin.casts.form', ['item' => $cast]);
    }

    public function update(Request $request, Cast $cast)
    {
        $cast->update($request->validate($this->rules()));

        return redirect()->route('admin.casts.index')->with('success', 'Cast diperbarui.');
    }

    public function destroy(Cast $cast)
    {
        $cast->perans()->delete();
        $cast->delete();

        return redirect()->route('admin.casts.index')->with('success', 'Cast dihapus.');
    }
}
