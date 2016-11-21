<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateVoteRequest;
use App\Models\Video;

class VideoVotesController extends Controller
{

    public function create(CreateVoteRequest $request, Video $video)
    {
        $this->authorize('vote', $video);

        $video->voteByUser()->delete();

        $video->votes()->create([
            'type' => $request->type,
            'user_id' => $request->user()->id
        ]);

        return response()->json(null, 200);
    }
    
    public function remove(Request $request, Video $video)
    {
        $this->authorize('vote', $video);

        $video->voteByUser()->delete();

        return response()->json(null, 200);
    }

    public function show(Request $request, Video $video)
    {
        $response = [
            'up' => null,
            'down' => null,
            'can_vote' => (bool)$video->allow_votes,
            'user_vote' => null,
        ];

        if ($video->allow_votes) {
            $response['up'] = $video->upVotes()->count();
            $response['down'] = $video->downVotes()->count();
        }

        if ($request->user()) {
            $response['user_vote'] = $video->user_vote_type ?: null;
        }

        return response()->json($response, 200);
    }
}
