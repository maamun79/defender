<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MissingPerson extends Model
{
    public function missingPersonLocationUpdates()
    {
        return $this->hasMany('App\MissingPersonLocationUpdate', 'mLocationupdate_id','id');
    }


    protected $fillable = [
        'name', 'dob', 'gender', 'height','weight','hair_color','eye_color', 'skin_color','missing_from', 'clothing_description', 'unique_identifiers', 'date_missing', 'details','photo'
    ];
}
