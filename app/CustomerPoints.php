<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPoints extends Model
{
    protected $guarded = [];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
