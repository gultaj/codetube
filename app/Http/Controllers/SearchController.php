<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Channel;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->q) {
            return redurect()->route('home');
        }

        $channels = Channel::search($request->q)->take(2)->get();

        return view('search.index',[
            'channels' => $channels
        ]);
    }
}
