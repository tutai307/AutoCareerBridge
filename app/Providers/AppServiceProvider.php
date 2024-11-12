<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $models = [
            'User',
        ];

        // phpcs:disable
        foreach ($models as $model) {
            $this->app->singleton(
                "App\\Repositories\\{$model}\\{$model}RepositoryInterface",
                "App\\Repositories\\{$model}\\{$model}Repository"
            );
        }
        // phpcs:enable
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
