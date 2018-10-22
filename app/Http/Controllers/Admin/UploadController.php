<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class UploadController extends Controller
{
    public function images(Request $request)
    {
        $images = [];
        $path = '/uploads/temp';
        $folder = public_path($path);
        if (!File::exists($folder)) File::makeDirectory($folder, 493, true);
        foreach ($request->file('images', []) as $image) {
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