<?php

namespace App\Transformers;

use App\Models\Channel;
use League\Fractal\TransformerAbstract;

class ChannelTransformer extends TransformerAbstract
{
    public function transform(Channel $channel)
    {
        return [
            'name' => $channel->name,
            'url' => route('channel', ['channel' => $channel->slug]),
            'image' => $channel->thumbnail_url
        ];
    }
}