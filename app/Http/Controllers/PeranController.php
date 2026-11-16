<?php

namespace App\Http\Controllers;

use App\Models\{Cast, Film, Peran};
use Illuminate\Http\Request;

class PeranController extends Controller
{
    private function rules(): array
    {
        return [
            'film_id' => 'required|exists:films,id',
            'cast_id' => 'required|exists:casts,id',
            'actor'   => 'required|string|max:255',
        ];
    }

    private function formData(Peran $item): array
    {
        return [
            'item'  => $item,
            'films' => Film::orderBy('title')->get(['id', 'title']),
            'casts' => Cast::orderBy('name')->get(['id', 'name']),
        ];
    }

    public function index()
    {
        $items = Peran::with('film:id,title', 'cast:id,name')->orderByDesc('id')->paginate(15);

        return view('admin.perans.index', compact('items'));
    }

    public function create()
    {
        return view('admin.perans.form', $this->formData(new Peran()));
    }

    public function store(Request $request)
    {
        Peran::create($request->validate($this->rules()));

        return redirect()->route('admin.perans.index')->with('success', 'Peran ditambahkan.');
    }

    public function edit(Peran $peran)
    {
        return view('admin.perans.form', $this->formData($peran));
    }

    public function update(Request $request, Peran $peran)
    {
        $peran->update($request->validate($this->rules()));

        return redirect()->route('admin.perans.index')->with('success', 'Peran diperbarui.');
    }

    public function destroy(Peran $peran)
    {
        $peran->delete();

        return redirect()->route('admin.perans.index')->with('success', 'Peran dihapus.');
    }
}
