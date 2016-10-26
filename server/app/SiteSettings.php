<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class SiteSettings extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'sitesettings';
    
    protected $fillable = [
          'logo',
          'contact_mail',
          'admin_email',
          'contact_address',
          'contact_no',
          'search_null_msg',
          'membership_pdf_link',
          'footer_disclaimer',
          'email_subscribe',
          'faq_header',
          'service_header',
          'testimonial_header',
          'get_in_touch'

    ];
    

    public static function boot()
    {
        parent::boot();

        SiteSettings::observe(new UserActionsObserver);
    }
    
    
    
    
}