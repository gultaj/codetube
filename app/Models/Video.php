<?php

namespace App\Models;

use App\Models\Channel;
use App\Models\Vote;
use App\Models\VideoView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Traits\Orderable;

class Video extends Model
{
    use SoftDeletes, Searchable, Orderable;

    protected $fillable = [
        'title', 'description', 'uid', 'video_processed', 'video_filename', 'processed', 
        'visibility', 'allow_votes', 'allow_comments', 'processed_percentage', 'thumbnail',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function views()
    {
        return $this->hasMany(VideoView::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('reply_id');
    }

    public function upVotes()
    {
        return $this->votes()->where('type', 'up');
    }
    
    public function downVotes()
    {
        return $this->votes()->where('type', 'down');
    }

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function getThumbnailAttribute($value)
    {
        if (!$this->processed || is_null($value)) {
            return config('codetube.video.default_thumb');
        }

        return $value;
    }

    public function getThumbnailUrlAttribute()
    {
        return asset('/storage' . $this->thumbnail);
    }

    public function getIsPrivateAttribute()
    {
        return $this->visibility === 'private';
    }

    public function getIsOwnerAttribute()
    {
        return \Auth::check() && $this->channel->user_id === \Auth::user()->id;
    }

    public function getCanViewAttribute()
    {
        //if (!\Auth::user() && $this->is_private) return false;

        if ($this->is_private && !$this->is_owner) return false;

        return true;
    }

    public function getUrlAttribute()
    {
        return "/storage{$this->video_processed}";
    }

    public function getViewCountAttribute()
    {
        return $this->views->count();
    }

    public function voteByUser()
    {
        return $this->votes()->where('user_id', \Auth::user()->id);
    }

    public function getUserVoteTypeAttribute()
    {
        if ($vote = $this->voteByUser()->first()) {
            return $vote->type;
        }
        return null;
    }

    public function scopeProcessed($query)
    {
        return $query->where('processed', true);
    }

    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }

    public function scopeVisible($query)
    {
        return $query->processed()->public();
    }
}
