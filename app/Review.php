<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;//追記

class Review extends Model
{
    use SoftDeletes;
    use Sortable;//追記

    protected $fillable = [
        'member_id',
        'product_id',
        'evaluation',
        'comment',
    ];


    public function member(){
        return $this->belongsTo('App\Member');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
