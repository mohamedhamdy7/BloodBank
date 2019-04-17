<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model 
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function clients()
    {
        return $this->belongsToMany('App\Client','blood_type_client','blood_type_id','client_id');
    }

    public function client()
    {
        return $this->hasMany('App\Client','blood_type_id');
    }

    public function requests()
    {
        return $this->hasMany('App\DonationRequest');
    }

}