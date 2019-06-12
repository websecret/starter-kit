<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\Image\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function images(Request $request)
    {
        $images = [];
        foreach ($request->file('images', []) as $image) {
            try {
                $image = Image::upload($image);
                $images[] = [
                    'path' => $image,
                    'src' => Image::encryptUrl($image),
                ];
            } catch (\Exception $e) {
                return [
                    'result' => 'error',
                    'message' => 'Невозможно загрузить выбранные изображения',
                ];
            }
        }
        return [
            'result' => 'success',
            'images' => $images,
        ];
    }

    public function froalaImages(Request $request)
    {
        $images = [];
        $path = '/uploads/wysiwyg/images';
        $folder = public_path($path);
        if (!File::exists($folder)) File::makeDirectory($folder, 493, true);
        $image = $request->file('file');
        do {
            $filename = str_random() . '.' . $image->getClientOriginalExtension();
        } while (File::exists($folder . '/' . $filename));
        try {
            $image->move($folder, $filename);
            $images[] = $path . '/' . $filename;
        } catch (\Exception $e) {
            return [
                'result' => 'error',
                'message' => 'Невозможно загрузить выбранные изображения',
            ];
        }
        return [
            'result' => 'success',
            'link' => $path . '/' . $filename,
        ];
    }

    public function files(Request $request)
    {
        $files = [];
        $path = '/uploads/temp';
        $folder = public_path($path);
        if (!File::exists($folder)) File::makeDirectory($folder, 493, true);
        foreach ($request->file('files', []) as $file) {
            try {
                $files[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $file->store('/', 'temp-files'),
                ];
            } catch (\Exception $e) {
                return [
                    'result' => 'error',
                    'message' => 'Невозможно загрузить выбранные файлы',
                ];
            }
        }
        return [
            'result' => 'success',
            'files' => $files,
        ];
    }
}