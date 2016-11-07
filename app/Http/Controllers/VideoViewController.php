<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Video;

class VideoViewController extends Controller
{
    public function store(Request $request, Video $video)
    {
        if (!$video->can_view) {
            return;
        }

        if ($request->user()) {
            $lastUserView = $video->views()->latestByUser($request->user())->first();
        }

        $video->views()->create([
            'user_id' => $request->user() ? $request->user()->id : null,
            'ip' => $request->ip(),
        ]);

        return response()->json(null, 200);
    }
}
