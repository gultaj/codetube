<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use FFMpeg\FFMpeg;

class TranscodeVideo implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $video = new FFMpeg::create();
        $video->open(storage_path() . "/{$this->video->video_filename}");
        //$video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(20))->save()
    }
}
