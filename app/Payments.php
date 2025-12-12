<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'name'
    ];

}
