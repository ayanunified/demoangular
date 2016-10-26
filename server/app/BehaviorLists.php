<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class BehaviorLists extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'behaviorlists';
    
    protected $fillable = ['type_name'];
    

    public static function boot()
    {
        parent::boot();

        BehaviorLists::observe(new UserActionsObserver);
    }
    
    
    
    
}