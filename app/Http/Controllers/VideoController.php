<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class VideoController extends Controller
{
    public function upload()
    {
        return view('video.upload');
    }

    public function store(Request $request)
    {
        $uid = uniqid(true);
        $channel = $request->user()->channel()->first();
        $video = $channel->videos()->create([
            'uid' => $uid,
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => $request->visibility,
            'video_filename' => "{$uid}.{$request->extension}",
        ]);

        return response()->json([
            'data' => [
                'uid' => $uid
            ]
        ]);
    }
}
