<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Channel;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChannelPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Channel $channel)
    {
        return $user->id === $channel->user_id;
    }

    public function edit(User $user, Channel $channel)
    {
        return $user->id === $channel->user_id;
    }

    public function subscribe(User $user, Channel $channel)
    {
        return !$user->ownsChannel($channel) && !$user->isSubscribedTo($channel);
    }

    public function unsubscribe(User $user, Channel $channel)
    {
        return $user->isSubscribedTo($channel);
    }
}
