<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Contactuspage extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'contactuspage';
    
    protected $fillable = ['title','content'];
    

    public static function boot()
    {
        parent::boot();

        Contactuspage::observe(new UserActionsObserver);
    }
    
    
    
    
}