<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Image\ImageableTrait;
use File;

class GenerateImagesConfig extends Command
{
    protected $signature = 'images:config';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sizes = [];
        $path = app_path(config('images.models_path'));
        $folder = public_path(config('images.folder'));
        foreach(File::allFiles($path) as $file) {
            $classname = str_replace('/', '\\', substr('App' . str_replace(app_path(), '', $file->getPathName()), 0, -4));
            $traits = class_uses($classname);
            if(isset($traits[ImageableTrait::class])) {
                $class = new $classname;
                $imageSizes = $class->getImagesSizes();
                if(!empty($imageSizes)) {
                    $imageModelPath =  $class->getImagesUploadPath();
                    $sizes[$imageModelPath] = $imageSizes;
                }
            }
        }

        $result = array_merge([
            'basePath' => $folder,
            'originalType' => 'original',
        ], $sizes);

        $json = json_encode($result);
        $text = 'module.exports = ' . $json;
        File::put(base_path('images.js'), $text);

        $array = var_export($result, true);
        $array = str_replace('array (', '[', $array);
        $array = str_replace(')', ']', $array);
        $array = str_replace("=> \n", '=> ', $array);
        $array = "<?php" . PHP_EOL . PHP_EOL . "return " . $array . ";" . PHP_EOL;
        File::put(base_path('images.php'), $array);
    }
}
