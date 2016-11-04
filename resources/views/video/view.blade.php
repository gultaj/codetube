@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if ($video->is_private && $video->is_owner)
                    <div class="alert alert-info">Your video is currently private. Only you can see it.</div>
                @endif

                @if ($video->processed)
                    Show video player
                @endif

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>{{ $video->title }}</h4>
                        <div class="pull-right">Video views</div>
                        <div class="media">
                            <div class="media-left">
                                <a href="{{ route('channel', ['channel' => $video->channel->slug]) }}">
                                    <img class="media-object" src="{{ url($video->channel->thumbnail) }}" alt="">                                    
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="{{ route('channel', ['channel' => $video->channel->slug]) }}" class="media-heading">
                                    {{ $video->channel->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($video->description)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {!! nl2br($video->description) !!}
                        </div>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-body">
                        @if ($video->allow_comments)
                            Comments
                        @else
                            <p>Comments are disabled for this video.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection