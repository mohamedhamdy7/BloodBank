<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model 
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('patient_name', 'patient_age', 'blood_type_id', 'blood_number', 'hospital_name', 'phone', 'notes', 'client_id', 'city_id', 'latitude', 'longitude');

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function blood_type()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification','donation_request_id');
    }
    public function clients(){
        return $this->belongsTo('App\Client','client_id');
    }

}