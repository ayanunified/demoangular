<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Emailverificationtokens extends Model {

   
    

    protected $table    = 'emailverificationtokens';
    
    protected $fillable = [
         'token',
         'status'
    ];
    
    
    
    
}