<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class FaqManagement extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'faqmanagement';
    
    protected $fillable = [
          'question',
          'answer'
    ];
    

    public static function boot()
    {
        parent::boot();

        FaqManagement::observe(new UserActionsObserver);
    }
    
    
    
    
}