<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use File;
use Illuminate\Support\Facades\Input;
trait AboutUsFileUploadTrait
{

    /**
     * File upload trait used in controllers to upload files
     */
    public function saveFilesaboutusowner(Request $request)
    {
        //echo 123;die;
        if (!file_exists('uploads/about_us')) {
            mkdir('uploads/about_us', 0777);
            mkdir('uploads/about_us/thumb', 0777);
        }
       foreach ($request->all() as $key => $value) {
           // echo '<pre>';
           // print_r($value);
            if ($request->hasFile($key)) {
                if ($request->has($key . '_w') && $request->has($key . '_h')) {
                    // Check file width
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $file     = $request->file($key);
                    $image    = Image::make($file);
                    Image::make($file)->resize(298, 273)->save('uploads/about_us/thumb' . '/' . $filename);
                    $width  = $image->width();
                    $height = $image->height();
                    if ($width > $request->{$key . '_w'} && $height > $request->{$key . '_h'}) {
                        $image->resize($request->{$key . '_w'}, $request->{$key . '_h'});
                    } elseif ($width > $request->{$key . '_w'}) {
                        $image->resize($request->{$key . '_w'}, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    } elseif ($height > $request->{$key . '_w'}) {
                        $image->resize(null, $request->{$key . '_h'}, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    $image->save('uploads/about_us'. '/' . $filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                    if(isset($request->all()['old_image'])){
                        File::Delete('uploads/about_us/'.$request->all()['old_image']);
                        File::Delete('uploads/about_us/thumb/'.$request->all()['old_image']);
                    }
                } else {
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $request->file($key)->move('uploads/about_us', $filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                    if(isset($request->all()['old_image'])){
                        File::Delete('uploads/about_us/'.$request->all()['old_image']);
                        File::Delete('uploads/about_us/thumb/'.$request->all()['old_image']);
                    }
                    
                }
            }
        }

        return $request;
    }
}
