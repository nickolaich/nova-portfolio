<?php

namespace Nickolaich\NovaPortfolio\Models;


use Illuminate\Database\Eloquent\Model;

class CollectionModel extends Model
{
    protected $table = 'collections';

    
    public function media(){
        return $this->belongsToMany(MediaModel::class, 'collection_media', 'collection_id', 'media_id');
    }

    public function landings(){
        return $this->hasMany(LandingModel::class, 'collection_id');
    }
}