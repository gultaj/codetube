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
                                        <div class="col-sm-3">thumbnail</div>
                                        <div class="col-sm-9">
                                            <a href="{{ route('video', ['video' => $video->uid]) }}">{{ $video->title }}</a>
                                            <div class="row">
                                                <div class="col-sm-6">data</div>
                                                <div class="col-sm-6">{{ ucfirst($video->visibility) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection