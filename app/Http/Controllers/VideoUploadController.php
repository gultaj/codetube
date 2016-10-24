<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class VideoUploadController extends Controller
{
    public function index()
    {
        return view('video.upload');
    }
}
