<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

abstract class Controller
{
    public function saveImage($image, $path = 'public')
    {
        $base_url = "http://172.20.10.13:8000";

        if (!$image) {
            return null;
        }

        $filename = time() . '.png';





        //save image

        Storage::disk($path)->put($filename, file_get_contents($image));

        //return path to image
        return $base_url . '/storage/' . $path . '/' . $filename;
    }
}
