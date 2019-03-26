<?php

namespace Nickolaich\NovaPortfolio\Models;


use Illuminate\Database\Eloquent\Model;

class LandingModel extends Model
{
    protected $table = 'landings';


    public function media()
    {
        return $this->belongsToMany(
            MediaModel::class,
            'landing_media',
            'landing_id',
            'media_id'
        )
            ->withPivot('position')
            ->orderBy('position');
    }

    public function collection()
    {
        return $this->belongsTo(CollectionModel::class, 'collection_id', 'id');
    }

    public function section()
    {
        return $this->belongsToMany(
            SectionModel::class,
            'landing_section',
            'landing_id',
            'section_id'
        )
            ->withPivot('position')
            ->orderBy('position');
    }
}