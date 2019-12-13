<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class Complain extends Model
{
    use Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'company_type', 'company_address', 'person_name', 'designation', 'sender_contact'
    ];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::created(function($model){
    //         $admins = User::all();
            
    //     });
    //     Notification::send($admins, new ComplainNotification($model));
    // }
    
}
