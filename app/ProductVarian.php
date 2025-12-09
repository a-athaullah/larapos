<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVarian extends Model
{
    protected $primaryKey = 'varian_id';
    protected $fillable = [
        'name', 'product_id', 'store_id'
    ];

}
