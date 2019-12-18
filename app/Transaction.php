<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Transaction extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function customers(){
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }
    public function transaction_details(){
        return $this->hasMany('App\TransactionDetails');
    }
    public function service(){
        return $this->belongsTo('App\Service');
    }
 
}
