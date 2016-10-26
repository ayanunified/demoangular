<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class SliderImages extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'sliderimages';
    
    protected $fillable = [
          'img_title',
          'img_path',
          'img_desc'
    ];
    

    public static function boot()
    {
        parent::boot();

        SliderImages::observe(new UserActionsObserver);
    }
    
    
    
    
}