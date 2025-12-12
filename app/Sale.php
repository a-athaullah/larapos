<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $primaryKey = 'sale_id';

    public $incrementing = true;

    protected $fillable = [
        'total', 'store_id', 'id', 'created'
    ];



    // This model can exists in N carts
    public function carts() {
        return $this->hasMany('App\Cart', 'sale_id');
    }

    public function store() {
        return $this->belongsTo('App\Store', 'store_id');
    }

    public function payment() {
        return $this->hasOne('App\Payment', 'payment_id');
    }

}
