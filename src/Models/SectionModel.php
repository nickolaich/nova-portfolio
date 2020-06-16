<?php

namespace Nickolaich\NovaPortfolio\Models;


use Illuminate\Database\Eloquent\Model;

class SectionModel extends Model
{
    protected $table = 'sections';


    public function landing()
    {
        return $this->belongsToMany(
            LandingModel::class,
            'landing_section',
            'section_id',
            'landing_id'
        )
            ->withPivot('position')->orderBy('position');
    }

    public static function types()
    {
        return [
            'text' => 'Text',
            'important' => 'Important Block'
        ];
    }
}
