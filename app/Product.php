<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function member(){
        return $this->belongsTo('App\Member');
    }
    public function productSubCategory(){
        return $this->belongsTo('App\ProductSubCategory');
    }
    public function ProductCategory(){
        return $this->belongsTo('App\ProductCategory');
    }
}
