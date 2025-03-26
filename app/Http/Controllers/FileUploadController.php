<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function update(Request $request)
    {
        // Single and multiple file validation
        $this->validate($request, [
            'avatar' => Rule::filepond([
                'required',
                'image',
                'max:2000'
            ]),
            'gallery.*' => Rule::filepond([
                'required',
                'image',
                'max:2000'
            ])
        ]);
    
        // Set filename
        $avatarName = 'avatar-' . auth()->id();
    
        // Move the file to permanent storage
        // Automatic file extension set
        $fileInfo = Filepond::field($request->avatar)
            ->moveTo('avatars/' . $avatarName);

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

        $galleryName = 'gallery-' . auth()->id();

        $fileInfos = Filepond::field($request->gallery)
            ->moveTo('galleries/' . $galleryName);
    
        // dd($fileInfos);
        // [
        //     [
        //         "id" => 1,
        //         "dirname" => "galleries",
        //         "basename" => "gallery-1-1.png",
        //         "extension" => "png",
        //         "mimetype" => "image/png",
        //         "filename" => "gallery-1-1",
        //         "location" => "galleries/gallery-1-1.png",
        //         "url" => "http://localhost/storage/galleries/gallery-1-1.png",
        //     ],
        //     [
        //         "id" => 2,
        //         "dirname" => "galleries",
        //         "basename" => "gallery-1-2.png",
        //         "extension" => "png",
        //         "mimetype" => "image/png",
        //         "filename" => "gallery-1-2",
        //         "location" => "galleries/gallery-1-2.png",
        //         "url" => "http://localhost/storage/galleries/gallery-1-2.png",
        //     ],
        //     [
        //         "id" => 3,
        //         "dirname" => "galleries",
        //         "basename" => "gallery-1-3.png",
        //         "extension" => "png",
        //         "mimetype" => "image/png",
        //         "filename" => "gallery-1-3",
        //         "location" => "galleries/gallery-1-3.png",
        //         "url" => "http://localhost/storage/galleries/gallery-1-3.png",
        //     ],
        // ]
    }
}
