<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    public function productCategory(){
        return $this->belongsTo('App\ProductCategory');
    }
    public function products(){
        return $this->hasMany('App\Product');
    }
}
