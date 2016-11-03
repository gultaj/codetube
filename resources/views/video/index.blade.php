@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Video</div>

                    <div class="panel-body">
                        @if ($videos->count())
                            @foreach ($videos as $video)
                                <div class="well">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <a href="{{ route('video', ['video' => $video->uid]) }}">
                                                <img src="{{ asset($video->thumbnail) }}" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="col-sm-9">
                                            <a href="{{ route('video', ['video' => $video->uid]) }}">{{ $video->title }}</a>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="muted">
                                                        @if (!$video->processed)
                                                            Processing ({{ !is_null($video->processed_percentage) ? $video->processed_percentage .'%' : 'Starting up' }})
                                                        @else
                                                            <span>{{ $video->created_at->toDateTimeString() }}</span>
                                                        @endif
                                                    </p>
                                                    <form action="{{ route('video.delete', ['video' => $video->uid]) }}" method="post">
                                                        <a href="{{ route('video.edit', ['video' => $video->uid]) }}" class="btn btn-default btn-xs">Edit</a>
                                                        <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                                        
                                                        {{ csrf_field() }}                                                    
                                                        {{ method_field('DELETE') }}                                                    
                                                    </form>
                                                </div>
                                                <div class="col-sm-6">{{ ucfirst($video->visibility) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $videos->links() }}
                        @else
                            <p>You have no videos</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection