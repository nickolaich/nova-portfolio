<?php

namespace Nickolaich\NovaPortfolio\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioModel extends Model
{

    protected $table = 'portfolios';

    protected $fillable = [
        'name',
        'description'
    ];

    public function media()
    {
        return $this->belongsToMany(MediaModel::class, 'media_portfolio', 'portfolio_id', 'media_id');
    }

    public function sliderCollection(){
        return $this->belongsTo(CollectionModel::class, 'slider_collection_id');
    }

    public function mainCollection(){
        return $this->belongsTo(CollectionModel::class, 'main_collection_id');
    }

    public function services()
    {
        return $this->hasMany(ServiceModel::class, 'portfolio_id');
    }

    public function testimonials()
    {
        return $this->hasMany(TestimonialModel::class, 'portfolio_id');
    }


}