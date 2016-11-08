<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Video;

class VideoViewController extends Controller
{
    const BUFFER = 30;

    public function store(Request $request, Video $video)
    {
        if (!$video->can_view) {
            return;
        }

        if ($request->user()) {
            $lastView = $video->views()->latestByUser($request->user())->first();
        } else {
            $lastView = $video->views()->latestByIp($request->ip())->first();
        }

        if ($this->withinBuffer($lastView)) {
            return;
        }

        $video->views()->create([
            'user_id' => $request->user() ? $request->user()->id : null,
            'ip' => $request->ip(),
        ]);

        return response()->json(null, 200);
    }

    protected function withinBuffer($view)
    {
        return $view && $view->created_at->diffInSeconds(Carbon::now()) < self::BUFFER;
    }
}
