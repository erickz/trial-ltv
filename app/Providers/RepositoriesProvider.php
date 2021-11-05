<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\UrlRepositoryInterface;
use App\Repositories\UrlRepository;

class RepositoriesProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UrlRepositoryInterface::class, UrlRepository::class);
    }
}
