<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Video;

class UploadThumbnail implements ShouldQueue
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
        $path = storage_path() . '/' . config('filesystems.temp_path') . '/';
        $input_file = $path . $this->video->thumbnail;
        $filename = pathinfo($input_file, PATHINFO_FILENAME);
        $output_file = "/video/thumb/{$filename}.png";
        \Log::info('input_file: ' . $input_file);
        \Image::make($input_file)->encode('png')->save();

        if (\Storage::put($output_file, fopen($input_file, 'r+'))) {
            \File::delete($input_file);
            $this->video->update([
                'thumbnail' => $output_file
            ]);
        }
    }
}
