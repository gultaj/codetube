<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Channel;
use App\Models\Video;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->q) {
            return redirect()->route('home');
        }

        $channels = Channel::search($request->q)->take(2)->get();
        $videos = Video::search($request->q)->take(4)->get();

        $videos->load('channel', 'views');

        return view('search.index',[
            'channels' => $channels,
            'videos' => $videos,
        ]);
    }
}
