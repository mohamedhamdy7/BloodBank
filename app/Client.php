<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'birth_date', 'donation_last_date', 'phone', 'password', 'city_id', 'blood_type_id', 'is_active', 'api_token','pin_code');
    protected  $hidden=array('password','api_token');
    public function requests()
    {
        return $this->hasMany('App\DonationRequest','client_id');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post','client_post','client_id','post_id');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Governorate','client_governorate','client_id','governorate_id');
    }

    public function blood_types()
    {
        return $this->belongsToMany('App\BloodType','blood_type_client','client_id','blood_type_id');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function blood_type()
    {
        return $this->belongsTo('App\BloodType','blood_type_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Notification','client_notification','client_id','notification_id');
    }

    public function tokens(){
        return $this->hasMany('App\Token','client_id');
    }

}