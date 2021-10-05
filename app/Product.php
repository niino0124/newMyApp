<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;//追記


class Product extends Model
{
    use SoftDeletes;
    use Sortable;//追記

    protected $fillable = [
        'member_id',
        'product_category_id',
        'product_subcategory_id',
        'name',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'product_content',
    ];

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


    // 総合評価平均取得
    public function getAvgStarAttribute()
    {
        return $this->attributes['avg_score'] = ceil($this->reviews->avg('evaluation'));
    }

}
