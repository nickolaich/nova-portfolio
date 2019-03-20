<?php

namespace Nickolaich\NovaPortfolio\Models;


use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    protected $table = 'services';

    
    public function portfolio(){
        return $this->belongsTo(PortfolioModel::class, 'portfolio_id', 'id');
    }


    public static function icons()
    {
        return [
            'icon_camera' => 'Camera',
            'icon_camera_alt' => 'Camera Alt',
            'icon_laptop' => 'Laptop',
        ];
    }
}