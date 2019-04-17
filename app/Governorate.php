<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\softDeletes;

class Governorate extends Model 
{

    use softDeletes;
    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name');

    public function cities()
    {
        return $this->hasMany('App\City');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client','client_governorate','governorate_id','client_id');
    }

}