<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVarian extends Model
{
    protected $primaryKey = 'varian_id';
    protected $fillable = [
        'name', 'product_id', 'store_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
