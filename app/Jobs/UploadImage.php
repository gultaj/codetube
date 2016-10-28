<?php

namespace App\Jobs;

use App\Models\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadImage implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $channel;
    public $fileId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Channel $channel, $fileId)
    {
        $this->channel = $channel;
        $this->fileId = $fileId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = storage_path() . '/' . config('filesistem.temp_path') . '/' . $this->fileId;
        $fileName = "/channels/{$this->fileId}.png";

        \Image::make($path)->encode('png')->fit(40, 40, function($c) {
            $c->upsize();
        })->save();

        if (\Storage::put($fileName, fopen($path, 'r+'))) {
            \File::delete($path);
            $this->channel->update([
                'image_filename' => $fileName
            ]);
        }
    }
}
