<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\Impl\CategoryRepositoryImpl;
use App\Repositories\Impl\ProductRepositoryImpl;
use App\Repositories\Impl\UserRepositoryImpl;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Services\CategoryService;
use App\Services\ConfigService;
use App\Services\Impl\CategoryServiceImpl;
use App\Services\Impl\ProductServiceImpl;
use App\Services\ProductService;
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
        $this->app->singleton(UserRepository::class, UserRepositoryImpl::class);

        $this->app->singleton(CategoryRepository::class, CategoryRepositoryImpl::class);
        $this->app->singleton(CategoryService::class, CategoryServiceImpl::class);

        $this->app->singleton(CategoryRepository::class, CategoryRepositoryImpl::class);
        $this->app->singleton(CategoryService::class, CategoryServiceImpl::class);

        $this->app->singleton(ProductRepository::class, ProductRepositoryImpl::class);
        $this->app->singleton(ProductService::class, ProductServiceImpl::class);
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
