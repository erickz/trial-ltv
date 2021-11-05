<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\TopUrlRepositoryInterface;
use App\Repositories\TopUrlRepository;

class RepositoriesProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TopUrlRepositoryInterface::class, TopUrlRepository::class);
    }
}
