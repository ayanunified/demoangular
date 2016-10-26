<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class AboutUs extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'aboutus';
    
    protected $fillable = ['about_content','trust_content','respect_content','passion_content'];
    

    public static function boot()
    {
        parent::boot();

        AboutUs::observe(new UserActionsObserver);
    }
    
    
    
    
}