<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jobs\TranscodeVideo;

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

        $request->file('video')->move(storage_path() . '/' . config('filesystems.temp_path'), $video->video_filename);

        dispatch(new TranscodeVideo($video)); 

        //  $ffmpeg = \FFMpeg\FFMpeg::create(['timeout' => 0]);
        //  $video_file = $ffmpeg->open(storage_path() . "/uploads/{$video->video_filename}");
        //  $format = new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264');
        //  $format->on('progress', function($file, $_format, $percentage) {
             
        //     dd($file->getFFProbe());
        //  });
        //  $video_file->save($format, storage_path() . "/uploads/{$video->video_filename}-x264.mp4");
        return response()->json(null, 200);
    }
}
