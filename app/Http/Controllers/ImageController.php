<?php

namespace App\Http\Controllers;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Own;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;


class ImageController extends Controller
{
   
     /**
     * Saving images uploaded through XHR Request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeImg(Request $given)
    {
       
        $this->validate($given,[
            'title'=> 'required|min:4|max:255',
            'address'=> 'required|min:10|max:255',
            'city'=> 'required|min:3|max:45',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
  
        $s=Auth::user()->customerId;
        
  
      if ($given->hasFile('file')) {
          $file = $given->file('file');
          $imageName = $s."_".$given->title."_".$given->nb_rooms."_".$file->getClientOriginalName();
          $path = $given->file('file')->store('images', 's3');
          $housing_id = Own::latest('id')->first();
            $upload = new Image();
            $upload->housing_id = $housing_id->id;
            $upload->filename = $imageName;
            $upload->url = Storage::disk('s3')->url($path);;
            $upload->save();
           
      }
 
        // return back()->withSuccess('Image tÃ©lÃ©chargÃ©e avec succÃ¨s');
        return redirect()->back()->with('message', 'Le logement a été correctement ajoutée!');
            
    }

}