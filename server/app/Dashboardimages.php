<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Dashboardimages extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'dashboardimages';
    
    protected $fillable = [
          'position',
          'img_path'
    ];
    

    public static function boot()
    {
        parent::boot();

        Dashboardimages::observe(new UserActionsObserver);
    }
    
    
    
    
}