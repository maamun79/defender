<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliceStation extends Model
{
    protected $fillable = [
        'name', 'email', 'contact','district'
    ];
}
