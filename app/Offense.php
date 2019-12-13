<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offense extends Model
{
    public function criminal()
    {
        return $this->belongsTo('App\Criminal','criminal_id','id');
    }

    protected $fillable = [
        'title', 'location', 'date', 'detain_date', 'release_date', 'release_type','statute','jedgment', 'victim_gender', 'victim_age'
    ];
}
