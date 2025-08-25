<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // opcional, si usas defaultStringLength

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Opcional para MySQL viejito:
        // Schema::defaultStringLength(191);
    }
}
