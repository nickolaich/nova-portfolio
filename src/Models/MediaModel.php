<?php

namespace Nickolaich\NovaPortfolio\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaModel extends Model
{
    protected $table = 'media';

    use \Spatie\Tags\HasTags;

    protected static function boot()
    {
        parent::boot();

        static::saving(function($model){
            if ($model->full_url) {
                // Use full url
                $model->full_remote_url = $model->full_url;
            } elseif ($model->full) {
                // If full is uploaded - prepare url to avoid access to cloud each time
                $model->full_remote_url = Storage::disk(config('nova-portfolio.media_disk'))->url($model->full);
            }
            if ($model->preview) {
                // If preview is uploaded - prepare url to avoid access to cloud each time
                $model->preview_remote_url = Storage::disk(config('nova-portfolio.media_disk'))->url($model->preview);
            }
        });
    }


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
        )
            ->withPivot(['position']);
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