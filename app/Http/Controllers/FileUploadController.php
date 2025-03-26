<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use RahulHaque\Filepond\Facades\Filepond;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048' // Max 2MB, only images
        ]);

        // Store file in the storage/app/public/uploads folder
        $path = $request->file('file')->store('uploads', 'public');

        // Return response with file URL
        return response()->json([
            'url' => Storage::url($path),
            'path' => $path
        ]);
    }

    /**
     * Teszt törölni!!!!
     */
    public function uploadCustomizeImage(Request $request)
    {
        // Single and multiple file validation
        $this->validate($request, [
            'front_image' => Rule::filepond([
                'required',
                'image',
                'max:10000'
            ]),
        ]);
    
        // Set filename
        $frontImageName = 'front-image-' . Str::random(7);
    
        // Move the file to permanent storage
        // Automatic file extension set
        $fileInfo = Filepond::field($request->front_image)->moveTo('customizations/' . $frontImageName);

        // dd($fileInfo);
        // [
        //     "id" => 1,
        //     "dirname" => "avatars",
        //     "basename" => "avatar-1.png",
        //     "extension" => "png",
        //     "mimetype" => "image/png",
        //     "filename" => "avatar-1",
        //     "location" => "avatars/avatar-1.png",
        //     "url" => "http://localhost/storage/avatars/avatar-1.png",
        // ];

     
    }
}
