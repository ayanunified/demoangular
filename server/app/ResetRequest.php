<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;



class ResetRequest extends Model {
    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */

    protected $table    = 'reset_request';
    
    protected $fillable = [
          'email',
          'token'
    ];
    

    public static function boot()
    {
        parent::boot();

        ResetRequest::observe(new UserActionsObserver);
    }
    
    


    
    
    
}