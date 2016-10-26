<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Businesses extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'businesses';
    
    protected $fillable = [
          'name',
          'note'
    ];
    

    public static function boot()
    {
        parent::boot();

        Businesses::observe(new UserActionsObserver);
    }
    
    
    
    
}