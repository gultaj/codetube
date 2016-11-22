<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Http\Requests;
use App\Http\Requests\CreateVideoCommentRequest;
use App\Transformers\CommentTransformer;

class VideoCommentsController extends Controller
{
    public function index(Video $video)
    {
        return response()->json(
            fractal()
                ->collection($video->comments()->with('user.channel', 'replies.user.channel')->latestFirst()->get())
                ->parseIncludes(['channel', 'replies', 'replies.channel'])
                ->transformWith(new CommentTransformer)
                ->toArray()
        );
    }

    public function create(CreateVideoCommentRequest $request, Video $video)
    {
        $this->authorize('comment', $video);

        $comment = $video->comments()->create([
            'body' => $request->body,
            'reply_id' => $request->get('reply_id', null),
            'user_id' => $request->user()->id,
        ]);
        
        $includes = ['channel'];
        if (!$request->reply_id) {
            $includes[] = 'replies';
        }

        return response()->json(
            fractal()
                ->item($comment)
                ->parseIncludes($includes)
                ->transformWith(new CommentTransformer)
                ->toArray()
        );
    }
}
