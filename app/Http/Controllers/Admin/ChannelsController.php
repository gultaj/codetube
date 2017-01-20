<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelUpdateRequest;

class ChannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::with('videos', 'subscriptions')->paginate(10);
        // dd($channels);
        return view('admin.channels.index')->with([
            'channels' => $channels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        return view('admin.channels.edit')->with([
            'channel' => $channel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChannelUpdateRequest $request, Channel $channel)
    {
        $channel->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->move(storage_path() . '/' . config('filesystems.temp_path'), $fileId = uniqid(true));

            dispatch(new UploadImage($channel, $fileId));
        }

        return redirect()->to("/admin/channels/{$channel->slug}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
