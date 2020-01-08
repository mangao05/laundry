<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function transactions(){
        return $this->hasMany('App\Transaction');
    }

    public function customer_points(){
        return $this->hasOne('App\CustomerPoints');
    }
}
