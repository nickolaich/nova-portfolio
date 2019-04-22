<?php
namespace Nickolaich\NovaPortfolio\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Nickolaich\NovaPortfolio\Services\PortfolioService;

class PortfolioController extends Controller
{
    public function portfolio($portfolioId, PortfolioService $service, Request $request)
    {

        return $service->findPortfolio($portfolioId, $request->input());
    }


    public function services($portfolioId, PortfolioService $service, Request $request)
    {
        return $service->getServices($portfolioId, $request->input());
    }

    public function offers($portfolioId, PortfolioService $service, Request $request)
    {
        return $service->getOffers($portfolioId, $request->input());
    }

    public function testimonials($portfolioId, PortfolioService $service, Request $request)
    {
        return $service->getTestimonials($portfolioId, $request->input());
    }

    public function collectionMedia($collectionId, PortfolioService $service, Request $request)
    {
        //$service->updateRemoteUrls($service->getCollectionMedia($collectionId));
        return $service->getCollectionMedia($collectionId, $request->input());
    }

}