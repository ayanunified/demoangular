<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Reportpatients extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'reportpatients';
    
    protected $fillable = [
          'position',
          'image_path'
    ];
    

    public static function boot()
    {
        parent::boot();

        Reportpatients::observe(new UserActionsObserver);
    }
    
    
    
    
}