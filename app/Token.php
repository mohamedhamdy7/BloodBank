<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table='tokens';
    public $timestamps = true;
    protected $fillable=['client_id','token','type'];

    public function client(){
        return $this->belongsTo('App\client','client_id');
    }
}
