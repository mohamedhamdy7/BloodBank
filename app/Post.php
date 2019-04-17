<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title_post', 'image', 'content_post', 'puplish_date', 'category_id');

    public function clients()
    {
        return $this->belongsToMany('App\Client','client_post','post_id','client_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }

}