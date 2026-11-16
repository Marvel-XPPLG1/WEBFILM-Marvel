<?php

namespace App\Http\Controllers;

use App\Models\{Film, Genre, Kritik};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilmController extends Controller
{
    // ================= PUBLIK =================

    public function movies()
    {
        $genreFilm = null;
        $films = Film::select('id', 'title', 'poster', 'year')
                ->orderByDesc('year')
                ->orderBy('created_at', 'asc')
                ->paginate(18);
        return view('components/movies', compact('films', 'genreFilm'));
    }

    public function show(Film $film)
    {
        $filmByGenre = Film::select('id', 'title', 'poster', 'year', 'sinopsis')
                        ->where('genre_id', '=', $film->genre_id)
                        ->orderBy('created_at', 'asc')
                        ->limit(7)
                        ->get();
        $filmByRelease = Film::select('id', 'title', 'poster', 'year')
                        ->where('year', '=', Carbon::now()->format('Y'))
                        ->orderBy('created_at', 'asc')
                        ->limit(9)
                        ->get();
        $comments = Kritik::with('user:id,name')
                        ->where('film_id', '=', $film->id)
                        ->orderByDesc('created_at')
                        ->limit(10)
                        ->get();
        $perans = $film->perans()->with('cast:id,name')->get();

        return view('components.movie-show', compact('film', 'filmByGenre', 'filmByRelease', 'comments', 'perans'));
    }

    public function movieHome()
    {
        $films = Film::select('id', 'title', 'poster', 'year')
                ->orderBy('created_at', 'asc')
                ->limit(9)->get();
        $filmFutured = Film::select('id', 'title', 'poster', 'year')
                        ->orderByDesc('year')
                        ->orderBy('created_at', 'asc')
                        ->limit(6)->get();
        $filmRecentAdded = Film::select('id', 'title', 'poster', 'year')
                            ->orderByDesc('created_at')
                            ->orderByDesc('id')
                            ->limit(6)->get();
        $filmSlidey = Film::select('title', 'poster', 'sinopsis')
                        ->orderByDesc('year')
                        ->orderBy('created_at', 'asc')
                        ->limit(6)->get();
        return view('components/home', compact('filmSlidey', 'films', 'filmFutured', 'filmRecentAdded'));
    }

    public function moviesByGenre($genre)
    {
        $genreFilm = Genre::where('id', '=', $genre)->first();
        $films = Film::select('id', 'title', 'poster', 'year')
                ->where('genre_id', '=', $genre)
                ->orderByDesc('year')
                ->orderBy('created_at', 'asc')
                ->paginate(18);
        return view('components/movies', compact('films', 'genreFilm'));
    }

    // ================= ADMIN CRUD =================

    private function rules(bool $posterRequired): array
    {
        return [
            'title'    => 'required|string|max:255',
            'sinopsis' => 'required|string',
            'year'     => 'required|integer|min:1888|max:2100',
            'genre_id' => 'required|exists:genres,id',
            'poster'   => ($posterRequired ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    private function savePoster(Request $request): string
    {
        $file = $request->file('poster');
        $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/posters'), $name);

        return 'uploads/posters/' . $name;
    }

    public function index()
    {
        $items = Film::with('genre:id,name')->orderByDesc('id')->paginate(15);

        return view('admin.films.index', compact('items'));
    }

    public function create()
    {
        return view('admin.films.form', ['item' => new Film()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(true));
        $data['poster'] = $this->savePoster($request);
        Film::create($data);

        return redirect()->route('admin.films.index')->with('success', 'Film ditambahkan.');
    }

    public function edit(Film $film)
    {
        return view('admin.films.form', ['item' => $film]);
    }

    public function update(Request $request, Film $film)
    {
        $data = $request->validate($this->rules(false));
        if ($request->hasFile('poster')) {
            $data['poster'] = $this->savePoster($request);
        } else {
            unset($data['poster']);
        }
        $film->update($data);

        return redirect()->route('admin.films.index')->with('success', 'Film diperbarui.');
    }

    public function destroy(Film $film)
    {
        DB::transaction(function () use ($film) {
            $film->perans()->delete();
            $film->kritiks()->delete();
            $film->delete();
        });

        return redirect()->route('admin.films.index')->with('success', 'Film dihapus.');
    }
}
