<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use File;
trait TestimonialFileUploadTrait
{

    /**
     * File upload trait used in controllers to upload files
     */
    public function saveFilesTesimonials(Request $request)
    {
        //echo 123;die;
        if (!file_exists('uploads/testimonials')) {
            mkdir('uploads/testimonials', 0777);
            mkdir('uploads/testimonials/thumb', 0777);
        }
       // echo '<pre>';
       // print_r($request->all());die;
        foreach ($request->all() as $key => $value) {
           // echo '<pre>';
           // print_r($value);
            if ($request->hasFile($key)) {
                if ($request->has($key . '_w') && $request->has($key . '_h')) {
                    // Check file width
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $file     = $request->file($key);
                    $image    = Image::make($file);
                    Image::make($file)->resize(150, 150)->save('uploads/testimonials/thumb' . '/' . $filename);
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
                    $image->save('uploads/testimonials'. '/' . $filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                    if(isset($request->all()['old_image'])){
                        File::Delete('uploads/testimonials/'.$request->all()['old_image']);
                        File::Delete('uploads/testimonials/thumb/'.$request->all()['old_image']);
                    }
                } else {
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $request->file($key)->move('uploads/testimonials', $filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                    if(isset($request->all()['old_image'])){
                        File::Delete('uploads/testimonials/'.$request->all()['old_image']);
                        File::Delete('uploads/testimonials/thumb/'.$request->all()['old_image']);
                    }
                    
                }
            }
        }

        return $request;
    }
}
