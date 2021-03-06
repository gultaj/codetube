<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Video $video)
    {
        return $user->id === $video->channel->user_id;
    }

    public function delete(User $user, Video $video)
    {
        return $user->id == $video->channel->user_id;
    }

    public function vote(User $user, Video $video)
    {
        // if (!$video->can_view) {
        //     return false;
        // }

        return $video->can_view && $video->allow_votes;
    }

    public function comment(User $user, Video $video)
    {
        return $video->can_view && $video->allow_comments;
    }
}
