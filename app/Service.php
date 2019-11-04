<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Service extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];


    public function transaction_items(){
        return $this->hasMany('App\TransactionItems');
    }

    public function scopeKilo($query){
        return $query->whereType('kilo');
    }

    public function scopeItem($query){
        return $query->whereType('item');
    }

    public function scopeFilterType($query, $type){
        return $query->where('type', $type);
    }

    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
}
