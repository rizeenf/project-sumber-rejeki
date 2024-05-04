<?php

namespace App\Traits;
use Illuminate\Http\Request;
use File;
use Image;

trait ImageUploadTraits{
    public function uploadImage(Request $request, $date, $codeItem, $namaItem, $inputName, $path){
        if($request->hasFile($inputName)){

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            if(strpos($codeItem,"'")){
                $codeItem = str_replace("'", '', $codeItem);
            }
    
            if(strpos($codeItem, '"')){
                $codeItem = str_replace('"', '', $codeItem);
            }
    
            if(strpos($codeItem, '/')){
                $codeItem = str_replace('/', '', $codeItem);
            }

            if(strpos($namaItem,"'")){
                $namaItem = str_replace("'", '', $namaItem);
            }
    
            if(strpos($namaItem, '"')){
                $namaItem = str_replace('"', '', $namaItem);
            }
    
            if(strpos($namaItem, '/')){
                $namaItem = str_replace('/', '', $namaItem);
            }
            $imageName = $codeItem.'-'.$namaItem.'-'.$date.'.'.$ext;

            $img = Image::make($image);
            // $img->rotate(-90);
            $img->save(public_path($path).$imageName, 40);

            return $path.'/'.$imageName;
        }
    }

    public function updateImage(Request $request, $date, $codeItem, $namaItem, $inputName, $path, $oldPath=null){
        if($request->hasFile($inputName)){
            if(File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            if(strpos($codeItem,"'")){
                $codeItem = str_replace("'", '', $codeItem);
            }
    
            if(strpos($codeItem, '"')){
                $codeItem = str_replace('"', '', $codeItem);
            }
    
            if(strpos($codeItem, '/')){
                $codeItem = str_replace('/', '', $codeItem);
            }

            if(strpos($namaItem,"'")){
                $namaItem = str_replace("'", '', $namaItem);
            }
    
            if(strpos($namaItem, '"')){
                $namaItem = str_replace('"', '', $namaItem);
            }
    
            if(strpos($namaItem, '/')){
                $namaItem = str_replace('/', '', $namaItem);
            }
            $imageName = $codeItem.'-'.$namaItem.'-'.$date.'.'.$ext;
            
            $img = Image::make($image);
            // $img->rotate(-90);
            $img->save(public_path($path).$imageName, 40);

            return $path.'/'.$imageName;
        }
    }

    public function deleteImage(string $path){
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}