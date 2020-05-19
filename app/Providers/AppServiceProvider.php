<?php

namespace App\Providers;

use App\Tag;
use App\Listing;
use App\Observers\TagObserver;
use App\Observers\ListingObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.default');

        Listing::observe(ListingObserver::class);

        Tag::observe(TagObserver::class);
    }
}
