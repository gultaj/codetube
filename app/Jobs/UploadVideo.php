<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Video;
use App\Jobs\TranscodeVideo;

class UploadVideo implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $video_filename;

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
        $path = storage_path() . '/' . config('filesistem.temp_path') . '/' . $this->video->video_filename;
        $fileName = 'videos/' . $this->video->video_filename;

        if (\Storage::put($fileName, fopen($path, 'r+'))) {
            \File::delete($path);
            $this->video->update([
                'video_filename' => $fileName
            ]);
            dispatch(new TranscodeVideo($video));
        }
    }
}
