<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ordersdetails extends Model
{
    protected $fillable = [
        'order_id', 'event_id', 'ticket_id','total', 'code'
    ];

    public function Event(){
        return $this->belongsTo('App\Model\Event');
    }

    public function Ticket(){
        return $this->belongsTo('App\Model\Ticket');
    }

    public function Checkout(){
        return $this->belongsTo('App\Model\Checkout');
    }


}
