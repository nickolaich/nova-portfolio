<?php

namespace Nickolaich\NovaPortfolio\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Nickolaich\NovaPortfolio\Models\CollectionModel;
use Nickolaich\NovaPortfolio\Models\PortfolioModel;
use Nickolaich\NovaPortfolio\Models\LandingModel;

class LandingService extends BaseService
{


    /**
     * @param $urlSlug
     * @return LandingModel|null
     */
    public function findLandingBySlug($urlSlug)
    {
        return LandingModel::where('url_slug', '=', $urlSlug)
            ->with('section')
            ->first();
    }

}