<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Traits\TestimonialFileUploadTrait;
use App\Http\Controllers\Traits\AboutUsFileUploadTrait;
abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FileUploadTrait,TestimonialFileUploadTrait,AboutUsFileUploadTrait;
}
