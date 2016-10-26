<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentReport extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'paymentreport';
    
    protected $fillable = [
          'customers_id',
          'transaction_id',
          'amount_paid',
          'pack_taken',
          'valid_till'
    ];
    

    public static function boot()
    {
        parent::boot();

        PaymentReport::observe(new UserActionsObserver);
    }
    
    public function customers()
    {
        return $this->hasOne('App\Customers', 'id', 'customers_id');
    }

    public function memberships()
    {
        return $this->belongsTo('App\Memberships','pack_taken','id');
    }

    
    
    
}