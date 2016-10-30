<?php

namespace App\Models;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'uid', 'video_processed', 'video_filename', 'processed', 
        'visibility', 'allow_votes', 'allow_comments', 'processed_percentage',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function getThumbnail()
    {
        if (!$this->processed) {
            return config('codetube.default_thumb');
        }

        return $this->thumb;
    }
}
