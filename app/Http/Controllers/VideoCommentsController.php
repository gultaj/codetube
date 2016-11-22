<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Http\Requests;
use App\Transformers\CommentTransformer;

class VideoCommentsController extends Controller
{
    public function index(Video $video)
    {
        return response()->json(
            fractal()
                ->collection($video->comments()->latestFirst()->get())
                ->parseIncludes(['channel', 'replies', 'replies.channel'])
                ->transformWith(new CommentTransformer)
                ->toArray()
        );
    }
}
