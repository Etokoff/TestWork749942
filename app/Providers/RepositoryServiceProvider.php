<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\ActorInterface',
            'App\Repositories\ActorRepository'
        );
        $this->app->bind(
            'App\Interfaces\MovieInterface',
            'App\Repositories\MovieRepository'
        );
    }
}
