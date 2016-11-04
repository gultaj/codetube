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
        'visibility', 'allow_votes', 'allow_comments', 'processed_percentage', 'thumbnail',
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

    public function getThumbnailAttribute($value)
    {
        if (!$this->processed || is_null($value)) {
            return config('codetube.video.default_thumb');
        }

        return '/storage/' . $value;
    }

    public function getIsPrivateAttribute()
    {
        return $this->visibility === 'private';
    }

    public function getIsOwnerAttribute()
    {
        return $this->channel->user_id === \Auth::user()->id;
    }
}
