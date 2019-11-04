<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TransactionDetails extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function transactions(){
        return $this->belongsTo('App\Transaction');
    }

    public function transaction_items(){
        return $this->hasMany('App\TransactionItem');
    }
}
