<?php 

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getVideosFromSubscription(User $user, $limit = 5)
    {
        return $user->subscribedChannels()->with(['videos' => function($query) use ($limit) {
            return $query->visible()->take($limit)->with('channel', 'views');
        }, ])->get()->pluck('videos')->flatten()->sortBydesc('created_at');
    }
}