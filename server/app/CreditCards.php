<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class CreditCards extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'creditcards';
    
    protected $fillable = [
          'card_number',
          'expire_month',
          'expire_year',
          'name',
          'security_code',
          'creditcardtypes_id',
          'customers_id'
    ];
    

    public static function boot()
    {
        parent::boot();

        CreditCards::observe(new UserActionsObserver);
    }
    
    public function creditcardtypes()
    {
        return $this->hasOne('App\CreditCardTypes', 'id', 'creditcardtypes_id');
    }


    public function customers()
    {
        return $this->hasOne('App\Customers', 'id', 'customers_id');
    }


    
    
    
}