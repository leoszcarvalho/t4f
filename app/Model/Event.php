<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'eventdate','location', 'state', 'image'
    ];

    protected $dates = ['deleted_at', 'created_at'];
}
