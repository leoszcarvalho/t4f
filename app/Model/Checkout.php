<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'client_id', 'date', 'authorization_code' ];

    public function Client(){
        return $this->belongsTo('App\Model\Client');
    }

}
