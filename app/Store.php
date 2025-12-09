<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $primaryKey = 'store_id';

    protected $fillable = [
        'name', 'description'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }

    public function categories(){
        return $this->hasMany('App\Category');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function sales(){
        return $this->hasMany('App\Sale');
    }
}
