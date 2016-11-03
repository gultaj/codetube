<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jobs\TranscodeVideo;

class VideoUploadController extends Controller
{
    public function index()
    {
        return view('video.upload');
    }

    public function store(Request $request)
    {
        $channel = $request->user()->channel()->first();
        $video = $channel->videos()->where('uid', $request->uid)->firstOrFail();

        $request->file('video')->move(storage_path() . '/' . config('filesystems.temp_path'), $video->video_filename);

        dispatch(new TranscodeVideo($video)); 

        return response()->json(null, 200);
    }
}
