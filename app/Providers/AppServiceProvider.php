<?php

namespace App\Providers;

use App\Contracts\SlugGeneratorInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Models\Article;
use App\Models\User;
use App\Observers\UserObserver;
use App\Repositories\User\UserRepository;
use App\Services\SlugGenerator;
use App\Services\UserService;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Facades\Filament;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(SlugGeneratorInterface::class, SlugGenerator::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ru','en', 'de', 'fr',]);
        });
        Paginator::useBootstrap();
    }
}
