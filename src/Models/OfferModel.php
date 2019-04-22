<?php

namespace Nickolaich\NovaPortfolio\Models;

use Illuminate\Database\Eloquent\Model;

class OfferModel extends Model
{
    protected $table = 'offers';


    public function portfolio()
    {
        return $this->belongsTo(PortfolioModel::class, 'portfolio_id', 'id');
    }
}