<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\Video;
use App\Models\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $channels = Channel::get()->count();
        $videos = Video::get()->count();
        $comments = Comment::get()->count();
        
        return view('admin.dashboard')->with([
            'video_count' => $videos,
            'channel_count' => $channels,
            'comment_count' => $comments,
        ]);
    }
}
