<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Stories extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'stories';
    
    protected $fillable = ['story_content'];
    

    public static function boot()
    {
        parent::boot();

        Stories::observe(new UserActionsObserver);
    }
    
    
    
    
}