<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'cpf', 'address','city', 'state', 'phone', 'email'
    ];
    protected $dates = ['deleted_at', 'created_at'];
}