<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class LoginLogs extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'loginlogs';
    
    protected $fillable = [
          'customers_id',
          'login_time',
          'logout_time',
          'patients_ids',
          'patients_search_id'
    ];
    

    public static function boot()
    {
        parent::boot();

        LoginLogs::observe(new UserActionsObserver);
    }
    
    public function customers()
    {
        return $this->hasOne('App\Customers', 'id', 'customers_id');
    }


    
    
    /**
     * Set attribute to datetime format
     * @param $input
     */
    public function setLoginTimeAttribute($input)
    {
        if($input != '') {
            $this->attributes['login_time'] = Carbon::createFromFormat(config('quickadmin.date_format') . ' ' . config('quickadmin.time_format'), $input)->format('Y-m-d H:i:s');
        }else{
            $this->attributes['login_time'] = '';
        }
    }

    /**
     * Get attribute from datetime format
     * @param $input
     *
     * @return string
     */
    public function getLoginTimeAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('quickadmin.date_format') . ' ' .config('quickadmin.time_format'));
        }else{
            return '';
        }
    }

/**
     * Set attribute to datetime format
     * @param $input
     */
    public function setLogoutTimeAttribute($input)
    {
        if($input != '') {
            $this->attributes['logout_time'] = Carbon::createFromFormat(config('quickadmin.date_format') . ' ' . config('quickadmin.time_format'), $input)->format('Y-m-d H:i:s');
        }else{
            $this->attributes['logout_time'] = '';
        }
    }

    /**
     * Get attribute from datetime format
     * @param $input
     *
     * @return string
     */
    public function getLogoutTimeAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('quickadmin.date_format') . ' ' .config('quickadmin.time_format'));
        }else{
            return '';
        }
    }


}