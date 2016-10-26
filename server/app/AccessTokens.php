<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;



class AccessTokens extends Model {


    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */

    protected $table    = 'accesstokens';
    
    protected $fillable = ['access_token',
                            'generate_time',
                            'customers_id'];
    

    public static function boot()
    {
        parent::boot();

        BehaviorLists::observe(new UserActionsObserver);
    }
    
    
    
    
}