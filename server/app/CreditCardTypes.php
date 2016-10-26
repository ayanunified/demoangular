<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class CreditCardTypes extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'creditcardtypes';
    
    protected $fillable = ['type_name'];
    

    public static function boot()
    {
        parent::boot();

        CreditCardTypes::observe(new UserActionsObserver);
    }
    
    
    
    
}