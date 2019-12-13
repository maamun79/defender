<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MissingPersonLocationUpdate extends Model
{
    public function missingPerson()
    {
        return $this->belongsTo('App\MissingPerson','missing_person_id','id');
    }

    protected $fillable = [
        'where_seen', 'clothing_details', 'details','date_of_seen','sender_name','sender_contact' 
    ];
}
