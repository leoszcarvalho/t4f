<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'price', 'tax', 'event_id'
    ];

    public function Event(){
        return $this->belongsTo('App\Model\Event');
    }

    protected $dates = ['deleted_at', 'created_at'];
}
