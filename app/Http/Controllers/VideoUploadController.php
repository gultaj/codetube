<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class VideoUploadController extends Controller
{
    public function index()
    {
        return view('videos.upload');
    }

    public function store(Request $request)
    {
        $channel = $request->user()->channel()->first();

        $video = $channel->videos()->where('uid', $request->uid)->firstOrFail();

        $request->file('video')->move(storage_path() . '/' . config('filesistem.temp_path'), $video->video_filename);
    }
}
