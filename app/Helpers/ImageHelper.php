<?php
namespace App\Helpers;
use Illuminate\Support\Str;
use Image;
class ImageHelper
{
    public static function handleUploadedImage($file, $path, $delete = null){
        if ($file) {
            if ($delete) {
                $deletePath = base_path('../') . $path . '/' . $delete;
                if (file_exists($deletePath)) {
                    unlink($deletePath);
                }
            }
            $name = time() . $file->getClientOriginalName();
            $file->move($path, $name);
            return $name;
        }
    }


    public static function ItemhandleUploadedImage($file, $path, $delete = null)
    {
        if ($file) {
            if ($delete) {
                $deletePath = base_path('../') . $path . '/' . $delete;
                if (file_exists($deletePath)) {
                    unlink($deletePath);
                }
            }

            $thum = Str::random(8) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(230, 230);
    
            $image->save(base_path('../') . $path . '/' . $thum);
    
            $photo = time() . $file->getClientOriginalName();
            $file->move($path, $photo);
            return [$photo, $thum];
        }
    }




    public static function handleUpdatedUploadedImage($file, $path, $data, $deletePath, $field){
    $name = time() . $file->getClientOriginalName();
    $file->move(public_path($path), $name);
    if ($data[$field] != null) {
        $deleteFilePath = public_path($deletePath) . $data[$field];
        if (file_exists($deleteFilePath)) {
            unlink($deleteFilePath);
        }
    }
    return $name;
  }



public static function ItemhandleUpdatedUploadedImage($file, $path, $data, $deletePath, $field){
    $photo = time() . $file->getClientOriginalName();
    $thum = Str::random(8) . '.' . $file->getClientOriginalExtension(); 
    $image = Image::make($file)->resize(230, 230);
    $image->save(public_path($path) . '/' . $thum);
    $file->move(public_path($path), $photo);
    if ($data['thumbnail'] != null) {
        $deleteThumbnailPath = public_path($deletePath) . $data['thumbnail'];
        if (file_exists($deleteThumbnailPath)) {
            unlink($deleteThumbnailPath);
        }
    }   
    if ($data[$field] != null) {
        $deleteFilePath = public_path($deletePath) . $data[$field];
        if (file_exists($deleteFilePath)) {
            unlink($deleteFilePath);
        }
    }     
    return [$photo, $thum];
}


   public static function handleDeletedImage($data, $field, $deletePath){
    if ($data[$field] != null) {
        $deleteFilePath = public_path($deletePath . $data[$field]);
        if (file_exists($deleteFilePath)) {
            unlink($deleteFilePath);
        }
    }
}


}
