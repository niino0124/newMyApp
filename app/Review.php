<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function member(){
        return $this->belongsTo('App\Member');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
