<?php
namespace Nickolaich\NovaPortfolio\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Nickolaich\NovaPortfolio\Services\LandingService;
use Nickolaich\NovaPortfolio\Services\PortfolioService;

class LandingController extends Controller
{
    public function show($urlSlug, LandingService $service, PortfolioService $portfolioService)
    {

        $landing = $service->findLandingBySlug($urlSlug);
        // No options yet
        $landing->options = null;
        $landing->gallery = $portfolioService->getCollectionMedia($landing->collection_id)->merge($portfolioService->prepareCollection($landing->media));
        return $landing;
    }

}