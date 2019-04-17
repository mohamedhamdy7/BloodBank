<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'donation_request_id');

    public function clients()
    {
        return $this->belongsToMany('App\Client','client_notification','notification_id','client_id');
    }

    public function request()
    {
        return $this->belongsToMany('App\DonationRequest','donation_request_id');
    }

}