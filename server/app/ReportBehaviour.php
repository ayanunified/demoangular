<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;



class ReportBehaviour extends Model {


    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */

    protected $table    = 'reportbehaviour';
    
    protected $fillable = ['report_id',
    					   'behaviorlists_id'];
    

    public static function boot()
    {
        parent::boot();

        ReportBehaviour::observe(new UserActionsObserver);
    }
   public function behaviorlists()
    {
        return $this->hasOne('App\BehaviorLists', 'id', 'behaviorlists_id');
    }
    
    
    
    
}