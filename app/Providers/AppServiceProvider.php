<?php

namespace App\Providers;

use App\Models\Genre;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapThree();

        try {
            view()->share('genres', Schema::hasTable('genres') ? Genre::all() : collect());
        } catch (\Throwable $e) {
            view()->share('genres', collect());
        }
    }
}