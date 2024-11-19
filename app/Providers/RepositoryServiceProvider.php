<?php

namespace App\Providers;


use App\Models\Hiring;
use App\Models\University;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\BaseRepositoryInterface;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\HiringRepository;
use App\Repositories\Company\HiringRepositoryInterface;
use App\Repositories\University\UniversityRepository;
use App\Repositories\University\UniversityRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $models = [
            'User',
            'Student'
        ];

        // phpcs:disable
        foreach ($models as $model) {
            $this->app->singleton(
                "App\\Repositories\\{$model}\\{$model}RepositoryInterface",
                "App\\Repositories\\{$model}\\{$model}Repository"
            );
        }
        // phpcs:enable
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(HiringRepositoryInterface::class, HiringRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(UniversityRepositoryInterface::class, UniversityRepository::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
