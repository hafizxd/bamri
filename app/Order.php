<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function bus() {
        return $this->belongsTo('App\Bus');
    }

    public function driver() {
        return $this->belongsTo('App\Driver');
    }
}
