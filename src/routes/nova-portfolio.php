<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => config('nova-portfolio.api_prefix'), 'namespace'=>'\Nickolaich\NovaPortfolio\Http\Controllers'], function ($router) {


    $router->get('portfolio/{portfolio}', 'PortfolioController@portfolio')->name('nova-portfolio.portfolio');
    $router->get('portfolio/{portfolio}/services', 'PortfolioController@services')->name('nova-portfolio.services');
    $router->get('portfolio/{portfolio}/testimonials', 'PortfolioController@testimonials')->name('nova-portfolio.testimonials');
    $router->get('collections/{collection}/media', 'PortfolioController@collectionMedia')->name('nova-portfolio.collection.media');

});