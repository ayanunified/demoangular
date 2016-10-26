<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class PatientReports extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'patientreports';
    
    protected $fillable = [
          'patients_id',
          'customers_id',
          'report_reason',
          'balance_amount',
          'service_date',
          'behaviorlists_id',
          'note',
          'report_date',
          'pack_taken'
    ];
    
    public static $report_reason = ["Balance" => "Balance", "Behavior" => "Behavior", "Both" => "Both"];


    public static function boot()
    {
        parent::boot();

        PatientReports::observe(new UserActionsObserver);
    }
    
    public function patients()
    {
        return $this->hasOne('App\Patients', 'id', 'patients_id');
    }


    public function customers()
    {
        return $this->hasOne('App\Customers', 'id', 'customers_id');
    }

    public function behaviorreported()
    {
        return $this->hasMany('App\ReportBehaviour', 'report_id', 'id');
    }


    public function behaviorlists()
    {
        return $this->hasOne('App\BehaviorLists', 'id', 'behaviorlists_id');
    }


    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setServiceDateAttribute($input)
    {
        if($input != '') {
            $this->attributes['service_date'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['service_date'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getServiceDateAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }

/**
     * Set attribute to date format
     * @param $input
     */
    public function setReportDateAttribute($input)
    {
        if($input != '') {
            $this->attributes['report_date'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['report_date'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getReportDateAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}