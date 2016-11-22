@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if ($video->is_private && $video->is_owner)
                    <div class="alert alert-info">Your video is currently private. Only you can see it.</div>
                @endif

                @if ($video->processed && $video->can_view)
                    <video-player video-uid="{{ $video->uid }}"
                        video-url="{{ $video->url }}"
                        thumbnail-url="{{ $video->thumbnail_url }}"></video-player>
                @endif
                
                @if (!$video->processed)
                    <div class="video-placeholder">
                        <div class="video-placeholder__header">This video is processing. Come back a bit later.</div>
                    </div>
                @elseif (!$video->can_view)
                    <div class="video-placeholder">
                        <div class="video-placeholder__header">This video is private</div>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>{{ $video->title }}</h4>
                        <div class="pull-right">
                            <div class="video__views">
                                {{ $video->view_count }} {{ str_plural('view', $video->view_count) }}
                            </div>
                            <video-voting video-uid="{{ $video->uid }}"></video-voting>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <a href="{{ route('channel', ['channel' => $video->channel->slug]) }}">
                                    <img class="media-object" src="{{ url($video->channel->thumbnail_url) }}" alt="">                                    
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
                            <video-comments video-uid="{{ $video->uid }}"></video-comments>
                        @else
                            <p>Comments are disabled for this video.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection