<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait FileUploadTrait
{

    /**
     * File upload trait used in controllers to upload files
     */
    public function saveFiles(Request $request)
    {
       // echo 123;die;
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777);
            mkdir('uploads/thumb', 0777);
        }
        foreach ($request->all() as $key => $value) {
            if ($request->hasFile($key)) {
                if ($request->has($key . '_w') && $request->has($key . '_h')) {
                    // Check file width
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $file     = $request->file($key);
                    $image    = Image::make($file);
                    Image::make($file)->resize(50, 50)->save('uploads/thumb/' . $filename);
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
                    $image->save('uploads/' . $filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                } else {
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $request->file($key)->move(public_path('uploads'), $filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                }
            }
        }

        return $request;
    }
    public function savePatientImage(Request $request)
    {
       // echo 123;die;
        if (!file_exists('uploads')) {
            mkdir('uploads/patients', 0777);
            mkdir('uploads/thumb', 0777);
        }
        foreach ($request->all() as $key => $value) {
            if ($request->hasFile($key)) {
                if ($request->has($key . '_w') && $request->has($key . '_h')) {
                    // Check file width
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $file     = $request->file($key);
                    $image    = Image::make($file);
                    Image::make($file)->resize(50,50)->save('uploads/thumb/' . $filename);
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
                    $image->save('uploads/patients/' . $filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                } else {
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $request->file($key)->move(public_path('uploads/patients'), $filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                }
            }
        }

        return $request;
    }
    public function saveMembershipPdf(Request $request)
    {
       // echo 123;die;
        if (!file_exists('uploads')) {
            mkdir('uploads/membership', 0777);
        }
        foreach ($request->all() as $key => $value) {
            if ($request->hasFile($key)) {
                $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                $request->file($key)->move(public_path('uploads/membership'), $filename);
                if($request->file($key)->getClientOriginalName()!="")
                {
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                }
                else{
                    
                    unset($request[$key]);
                }    
            }
        }
        return $request;
    }
    public function saveFilesService(Request $request)
    {
        if (!file_exists('uploads')) {
            mkdir('uploads/service', 0777);
            mkdir('uploads/thumb', 0777);
        }
        foreach ($request->all() as $key => $value) {
            echo 'hii';
            if ($request->hasFile($key)) {

                if ($request->has($key . '_w') && $request->has($key . '_h')) {
                    // Check file width
                    echo $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $file     = $request->file($key);
                    $image    = Image::make($file);
                    Image::make($file)->resize(50,50)->save('uploads/thumb/' . $filename);
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
                    $image->save('uploads/service/' . $filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                } else {
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $request->file($key)->move(public_path('uploads/service'), $filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                }
            }
        }
        //pr($request);
        die;
        return $request;
    }
}
