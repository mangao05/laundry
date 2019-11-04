<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $guarded = [];

    public function transaction_details(){
        return $this->belongsTo('App\TransactionItem');
    }

    public function service(){
        return $this->belongsTo('App\Service');
    }
}
