<?php

namespace Nickolaich\NovaPortfolio\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaModel extends Model
{
    protected $table = 'media';

    use \Spatie\Tags\HasTags;

    public function portfolio()
    {
        return $this->belongsToMany(
            PortfolioModel::class,
            'media_portfolio',
            'media_id',
            'portfolio_id'
        );
    }

    public function collection()
    {
        return $this->belongsToMany(
            CollectionModel::class,
            'collection_media',
            'media_id',
            'collection_id'
        );
    }

    public function landing()
    {
        return $this->belongsToMany(
            LandingModel::class,
            'landing_media',
            'media_id',
            'landing_id'
        )
            ->withPivot('position');
    }
}