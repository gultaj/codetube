<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Http\Requests;

class ChannelController extends Controller
{
    public function show(Channel $channel)
    {
        return view('channel.show', [
            'channel' => $channel,
            'videos' => $channel->videos()->latestFirst()->paginate(2)
        ]);
    }
}
