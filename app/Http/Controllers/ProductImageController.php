<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Delete a product image
     */
    public function destroy(ProductImage $image)
    {
        \Log::info('Deleting image', ['image_id' => $image->id, 'path' => $image->image_path]);

        // Delete file
        Storage::disk('public')->delete($image->image_path);

        // Delete DB record
        $image->delete();

        return response()->json(['message' => 'Image deleted']);
    }

    /**
     * Reorder product images
     */
    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $item) {
            ProductImage::where('id', $item['id'])->update(['order' => $index + 1]);
        }

        return response()->json(['status' => 'success']);
    }

}
