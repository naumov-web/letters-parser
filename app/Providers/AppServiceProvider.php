<?php

namespace App\Providers;

use App\Models\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Collection
        $this->app->bind(
            Collection\Contracts\ICollectionService::class,
            Collection\Services\Service::class
        );
        $this->app->bind(
            Collection\Contracts\IDatabaseRepository::class,
            Collection\Repositories\DatabaseRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
