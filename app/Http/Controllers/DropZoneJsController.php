<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class DropZoneJsController extends Controller
{
    public function storeMedia(Request $request)
    {
        //resize image
        $path = storage_path('tmp/uploads');
        $imgwidth = 1000;
        $imgheight = 1000;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
//        $file->move($path,$name);
        $full_path = storage_path('tmp/uploads/'.$name);
        $img = \Image::make($file->getRealPath())->orientate();
        if ($img->width() > $imgwidth || $img->height() > $imgheight) {
            // See the docs - http://image.intervention.io/api/resize
            // resize the image to a width of 300 and constrain aspect ratio (auto height)
            $img->resize($imgwidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $img->save($full_path);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
            'path_url' => env('app_url').'/tmp/uploads/'.$name,
        ]);
    }
}
