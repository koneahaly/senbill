<?php

namespace App\Http\Controllers;
use App\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;


class ImageController extends Controller
{
    // public function image_displying()
    // {
    //   $url = 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
    //   $images = [];
    //   $files = Storage::disk('s3')->files('images');
    //   foreach ($files as $file) {
    //   $images[] = [
    //   'name' => str_replace('images/', '', $file),
    //   'src' => $url . $file
    //   ];
    //   }
    //   return view('ownerProperties', 'images');

    // }

     /**
     * Saving images uploaded through XHR Request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeImg(Request $given)
    {
       
        $given->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        if ($given->hasFile('file')) {
            $file = $given->file('file');
            $imageName=time().$file->getClientOriginalName();
            $filePath = 'images/' . $imageName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
        }
 
        return back()->withSuccess('Image téléchargée avec succès');
    
    }

    //
}
