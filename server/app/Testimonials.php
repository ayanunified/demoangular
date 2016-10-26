<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonials extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'testimonials';
    
    protected $fillable = [
          'user_img',
          'title',
          'description'
    ];
    

    public static function boot()
    {
        parent::boot();

        Testimonials::observe(new UserActionsObserver);
    }
    
    
    
    
}