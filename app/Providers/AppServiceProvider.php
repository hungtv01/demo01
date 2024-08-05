<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\CMS\Page;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
     
        $this->loadRoutesFrom(base_path('routes/web_cms.php'));
        View::share('globalData', [
            'menu' => Page::where('parent_id', NULL)->with('childrens')->orderBy('order')->get(),
        ]);

    }
}
