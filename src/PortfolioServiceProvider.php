<?php

namespace Nickolaich\NovaPortfolio;

use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Nickolaich\NovaPortfolio\Nova\Resources\CollectionResource;
use Nickolaich\NovaPortfolio\Nova\Resources\LandingResource;
use Nickolaich\NovaPortfolio\Nova\Resources\MediaResource;
use Nickolaich\NovaPortfolio\Nova\Resources\OfferResource;
use Nickolaich\NovaPortfolio\Nova\Resources\PortfolioResource;
use Nickolaich\NovaPortfolio\Nova\Resources\SectionResource;
use Nickolaich\NovaPortfolio\Nova\Resources\ServiceResource;
use Nickolaich\NovaPortfolio\Nova\Resources\TestimonialResource;
use Nickolaich\NovaPortfolio\Services\LandingService;
use Nickolaich\NovaPortfolio\Services\PortfolioService;

class PortfolioServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->mergeConfigFrom(__DIR__.'/config/nova-portfolio.php', 'nova-portfolio');
        $this->loadRoutesFrom(__DIR__.'/routes/nova-portfolio.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'nova-portfolio');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'nova-portfolio');
    }

    protected function resources()
    {

        Nova::resources([
            PortfolioResource::class,
            MediaResource::class,
            CollectionResource::class,
            SectionResource::class,
            LandingResource::class,
            ServiceResource::class,
            TestimonialResource::class,
            OfferResource::class,
        ]);
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PortfolioService::class, PortfolioService::class);
        $this->app->bind(LandingService::class, LandingService::class);
    }
}