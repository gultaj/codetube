<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Video;
use App\Jobs\UploadVideo;

class TranscodeVideo implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $video;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = storage_path()  . '/' . config('filesystems.temp_path') . '/';

        $ffmpeg = \FFMpeg\FFMpeg::create(['timeout' => 0]);
        $video = $ffmpeg->open($path . $this->video->video_filename);
        //$video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(20))->save()
        $format = new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264');

        $format->on('progress', function($file, $format, $percentage) {
            $this->video->update(['processed_percentage' => $percentage]);
        });
        $transcoded_filename = "{$this->video->video_filename}-x264.mp4";
        $video->save($format, $path . $transcoded_filename);

        $this->video->update([
            'processed_percentage' => null,
            'processed' => true,
            'video_processed' => $transcoded_filename
        ]);

        dispatch(new UploadVideo($this->video));
    }
}