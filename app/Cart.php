<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected  $table = 'carts';

    protected $primaryKey = ['sale_id', 'product_id'];

    public $incrementing = false;

    // $table->unsignedInteger('amount');
    //         $table->unsignedFloat('price');
    //         $table->unsignedFloat('cost');
    //         $table->unsignedFloat('total_cost');

    protected $fillable = [
        'sale_id', 
        'product_id',
        'amount', 
        'price',
        'cost',
        'total_cost',
        'total_price',
        'store_id', 
        'created'
    ];

    //This model can have one or many sales
    public function sales() {
        return $this->hasMany('App\Sale', 'sale_id', 'sale_id');
    }

    //This model can have one or many products
    public function products() {
        return $this->hasMany('App\Product', 'product_id', 'product_id');
    }
}
