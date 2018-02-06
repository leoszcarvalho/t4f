<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $fillable = [
        'token', 'event_id', 'ticket_id','client_id', 'qtd'
    ];

    public function Event(){
        return $this->belongsTo('App\Model\Event');
    }

    public function Ticket(){
        return $this->belongsTo('App\Model\Ticket');
    }

    public function Client(){
        return $this->belongsTo('App\Model\Client');
    }

}
