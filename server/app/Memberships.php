<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Memberships extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'memberships';
    
    protected $fillable = [
          'type_name',
          'duration',
          'price',
          'subheading',
          'description'
    ];
    

    public static function boot()
    {
        parent::boot();

        Memberships::observe(new UserActionsObserver);
    }
    
    
    
    
}