<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;


class ProductCategory extends Model
{

    use SoftDeletes;
    use Sortable;

    public $sortable = ['id','created_at'];

    protected $fillable = [
        'name','product_category_id'
    ];


    public function productSubcategories(){
        return $this->hasMany('App\ProductSubcategory');
    }



    public function products(){
        return $this->hasMany('App\Product');
    }
}
