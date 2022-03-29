<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\Impl\CategoryRepositoryImpl;
use App\Services\CategoryService;
use App\Services\ConfigService;
use App\Services\Impl\CategoryServiceImpl;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider;
use DB;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ConfigService::class);
        $this->app->singleton(CategoryRepository::class, CategoryRepositoryImpl::class);
        $this->app->singleton(CategoryService::class, CategoryServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function (QueryExecuted $query) {
            Log::info('query: ' . $query->sql);
            Log::info('bindings: ' . implode(',', $query->bindings));
            Log::info('time: ' . $query->time);
        });
//        DB::enableQueryLog();
    }
}
