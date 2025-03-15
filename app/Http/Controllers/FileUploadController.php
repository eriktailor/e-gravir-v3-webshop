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
}
