<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $guarded = [];

    public function orders() {
        return $this->hasMany('App\Order');
    }
}
