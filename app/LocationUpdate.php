<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationUpdate extends Model
{
    public function criminal()
    {
        return $this->belongsTo('App\Criminal','criminal_id','id');
    }

    protected $fillable = [
        'location', 'description', 'sender_contact' 
    ];
    
}
