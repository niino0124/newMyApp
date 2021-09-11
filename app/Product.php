<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $dates = ['display_date'];
    
    public function member(){
        return $this->belongsTo('App\Member');
    }
    public function productCategory(){
        return $this->belongsTo('App\ProductCategory');
    }
    public function productSubcategory(){
        return $this->belongsTo('App\ProductSubcategory');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }

    public function getAvgStarAttribute()
    {
        return $this->attributes['avg_score'] = ceil($this->reviews->avg('evaluation'));
    }

}
