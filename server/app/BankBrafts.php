<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class BankBrafts extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'bankbrafts';
    
    protected $fillable = [
          'bank_acc_no',
          'routing_number',
          'customers_id'
    ];
    

    public static function boot()
    {
        parent::boot();

        BankBrafts::observe(new UserActionsObserver);
    }
    
    public function customers()
    {
        return $this->hasOne('App\Customers', 'id', 'customers_id');
    }


    
    
    
}