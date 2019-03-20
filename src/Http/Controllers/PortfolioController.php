<?php
namespace Nickolaich\NovaPortfolio\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Nickolaich\NovaPortfolio\Services\PortfolioService;

class PortfolioController extends Controller
{
    public function portfolio($portfolioId, PortfolioService $service)
    {

        return $service->findPortfolio($portfolioId);
    }


    public function services($portfolioId, PortfolioService $service)
    {
        return $service->getServices($portfolioId);
    }

    public function testimonials($portfolioId, PortfolioService $service)
    {
        return $service->getTestimonials($portfolioId);
    }

    public function collectionMedia($collectionId, PortfolioService $service)
    {
        //$service->updateRemoteUrls($service->getCollectionMedia($collectionId));
        return $service->getCollectionMedia($collectionId);
    }

}