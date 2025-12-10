<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name', 'store_id'
    ];

    //This model groups 1 or N products
    public function products() {
        return $this->hasMany('App\Product', 'category_id');
    }
}
