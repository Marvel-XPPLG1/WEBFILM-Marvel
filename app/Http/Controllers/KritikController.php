<?php

namespace App\Http\Controllers;

use App\Models\{Film, Kritik};
use Illuminate\Http\Request;

class KritikController extends Controller
{
    // Hanya user biasa yang boleh memberi komentar/kritik
    public function store(Request $request, Film $film)
    {
        if ($request->user()->isAdmin()) {
            abort(403, 'Administrator tidak dapat memberikan komentar pada film.');
        }

        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Kritik::create([
            'comment' => $data['comment'],
            'rating'  => $data['rating'],
            'film_id' => $film->id,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('movies.show', $film->id)->with('success', 'Komentar berhasil dikirim.');
    }
}
