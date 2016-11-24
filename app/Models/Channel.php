<?php

namespace App\Models;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Channel extends Model
{
    use Searchable;

    protected $fillable = [
        'name', 'slug', 'description', 'image_filename'        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscriptionCount()
    {
        return $this->subscriptions->count();
    }

    public function totalVideoViews()
    {
        return $this->hasManyThrough(VideoView::class, Video::class)->count();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getThumbnailAttribute()
    {
        if (is_null($this->image_filename)) {
            return config('codetube.channel.default_thumb');
        }

        return $this->image_filename;
    }

    public function getThumbnailUrlAttribute()
    {
        return asset('/storage' . $this->thumbnail);
    }


}
