<?php

namespace App\Providers;

use App\Http\Resources\Api\BaseApiResource;
use App\Models\Collection;
use App\Models\CollectionItem;
use App\Models\File;
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
        // Collection item
        $this->app->bind(
            CollectionItem\Contracts\IDatabaseRepository::class,
            CollectionItem\Repositories\DatabaseRepository::class
        );
        // File
        $this->app->bind(
            File\Contracts\IFileService::class,
            File\Services\Service::class
        );
        $this->app->bind(
            File\Contracts\IDatabaseRepository::class,
            File\Repositories\DatabaseRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        BaseApiResource::withoutWrapping();
    }
}
