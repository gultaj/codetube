<?php

namespace App\Models;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getThumbnailAttribute()
    {
        if (is_null($this->image_filename)) {
            return config('codetube.channel.default_thumb');
        }

        return '/storage/' . $this->image_filename;
    }
}
