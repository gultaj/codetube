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
        $moveFile = function($keyName, $folderName) {
            $path = storage_path() . '/' . config('filesystems.temp_path') . '/' . $this->video->$keyName;
            $fileName = "{$folderName}{$this->video->$keyName}";

            if (\Storage::put($fileName, fopen($path, 'r+'))) {
                \File::delete($path);
                $this->video->update([$keyName => $fileName]);
            }
        };

        $moveFile('video_filename', '/video/original/');
        $moveFile('video_processed', '/video/');
    }

}
