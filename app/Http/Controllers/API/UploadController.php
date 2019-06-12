<?php

namespace App\Http\Controllers\API;

use App\Models\Image\Image;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadController extends Controller
{
    public function image(Request $request)
    {
        $rules = [
            'image' => [
                'required',
            ],
        ];

        $file = $request->file('image', $request->input('image'));

        if ($file instanceof UploadedFile) {
            $rules['image'][] = 'image';
        }

        $this->validate($request, $rules);

        $image = Image::upload($file);

        return [
            'path' => $image,
            'src' => Image::encryptUrl($image),
        ];
    }
}
