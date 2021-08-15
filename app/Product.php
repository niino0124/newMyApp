<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function member(){
        return $this->belongsTo('App\Member');
    }
    public function productCategory(){
        return $this->belongsTo('App\ProductCategory');
    }
}
