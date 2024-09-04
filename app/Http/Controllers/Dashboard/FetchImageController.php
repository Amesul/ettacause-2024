<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use JetBrains\PhpStorm\NoReturn;

class FetchImageController extends Controller
{
    #[NoReturn] public function fetchImage()
    {

        $url = $_GET["url"];                     // the image URL
        $info = getimagesize($url);              // get image data
        header("Content-type: " . $info['mime']); // act as image with right MIME type
        readfile($url);                          // read binary image data
        die();
    }
}
