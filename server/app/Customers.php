<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Support\Facades\Hash; 

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'customers';
    
    protected $fillable = [
          'legalName',
          'businessName',
          'businesses_id',
          'address',
          'suite',
          'city',
          'state',
          'country',
          'zip',
          'office_phone',
          'email',
          'emailValidateToken',
          'website',
          'noOfDoc',
          'first_name',
          'last_name',
          'cell_phone',
          'username',
          'password',
          'status',
          'expiry_date',
          'memberships_id',
          'sales_person_id',
          'refer_id',
          'refer_chanel'
    ];
    
    public static $status = ["Active" => "Active", "Inactive" => "Inactive", "Block" => "Block"];
    public static $membership_type = ["Trial" => "Trial", "Monthly" => "Monthly", "Yearly" => "Yearly", "Lifetime" => "Lifetime"];


    public static function boot()
    {
        parent::boot();

        Customers::observe(new UserActionsObserver);
    }
    
    public function businesses()
    {
        return $this->hasOne('App\Businesses', 'id', 'businesses_id');
    }
    public function memberships()
    {
        return $this->hasOne('App\Memberships', 'id', 'memberships_id');
    }


    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        $this->attributes['password'] = Hash::make($input);
    }


    /**
     * Set attribute to date format
     * @param $input
     */
    public function setExpiryDateAttribute($input)
    {
        if($input != '') {
            $this->attributes['expiry_date'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['expiry_date'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getExpiryDateAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}
