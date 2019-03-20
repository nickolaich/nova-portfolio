<?php

namespace Nickolaich\NovaPortfolio\Models;


use Illuminate\Database\Eloquent\Model;

class TestimonialModel extends Model
{
    protected $table = 'testimonials';

    
    public function portfolio(){
        return $this->belongsTo(PortfolioModel::class, 'portfolio_id', 'id');
    }
    
}