@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Search for "{{ Request::get('q') }}"</div>
                    <div class="panel-body">
                        @if ($channels->count())
                            <h4>Channels</h4>
                            <div class="well">
                                @foreach ($channels as $channel)
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="{{ route('channel', ['channel' => $channel->slug]) }}">
                                                <img src="{{ $channel->thumbnail_url }}" alt="{{ $channel->name }} image" channel="media-object">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="{{ route('channel', ['channel' => $channel->slug]) }}" class="media-heading">{{ $channel->name }}</a>
                                            <ul class="list-inline">
                                                <li>{{ $channel->subscriptionCount() }} {{ str_plural('subscriber', $channel->subscriptionCount()) }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            No channels found
                        @endif
                        @if ($videos->count())
                            <h4>Videos</h4>
                            <div class="well">
                                @foreach ($videos as $video)
                                    @include('video.partials._search', ['video' => $video]);
                                @endforeach
                            </div>
                        @else
                            No videos found
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
