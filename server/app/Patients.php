<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class Patients extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'patients';
    
    protected $fillable = [
          'first_name',
          'middle_name',
          'last_name',
          'img_path',
          'dob',
          'gender',
          'ssn',
          'address',
          'apt',
          'city',
          'state',
          'zipcode',
          'home_phone',
          'customers_id'
    ];
    
    public static $gender = ["MALE" => "MALE", "FEMALE" => "FEMALE"];


    public static function boot()
    {
        parent::boot();

        Patients::observe(new UserActionsObserver);
    }
    
    public function customers()
    {
        return $this->hasOne('App\Customers', 'id', 'customers_id');
    }


    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDobAttribute($input)
    {
        if($input != '') {
            $this->attributes['dob'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['dob'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDobAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}