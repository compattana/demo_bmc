<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropZoneJsFileController extends Controller
{
    public function storeMedia(Request $request)
    {
        $path = public_path('tmp/uploads');

        if (!file_exists($path)) {
            if (!mkdir($path, 0777, true) && !is_dir($path)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
        }

        $file = $request->file('file');

        $name = uniqid('', true) . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
