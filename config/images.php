<?php

$folder = 'uploads' . DIRECTORY_SEPARATOR . 'images';

return [
    'folder' => $folder,
    'url' => env('IMAGES_URL', env('APP_URL') . DIRECTORY_SEPARATOR . $folder),
    'models_path' => 'Models',
];