<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criminal extends Model
{
    
    public function offenses()
    {
        return $this->hasMany('App\Offense', 'offense_id','id');
    }

    public function locationUpdates()
    {
        return $this->hasMany('App\LocationUpdate', 'locationupdate_id','id');
    }


    protected $fillable = [
        'name', 'dob', 'nid', 'residence', 'skin_color', 'hair_color', 'height', 'gender', 'current_threat_level', 'current_status', 'photo','registration_ending_date','state'
    ];
    
}
