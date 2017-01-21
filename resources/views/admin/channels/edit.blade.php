@extends('adminlte::page')

@section('title', 'Edit channel')

@section('content_header')
    <h1>Edit {{ $channel->name }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/channels') }}"><i class="fa fa-list"></i> Channels</a></li>
        <li class="active">{{ $channel->name }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-body">
                    <form class="form-horizontal" role="form" method="POST" action="/admin/channels/{{ $channel->slug }}" enctype="multipart/form-data">
                        @include('admin.channels.partials.form', ['channel' => $channel, 'errors' => $errors])
                        {{ method_field('PUT') }}
                    </form>
                </div>
            </div>
        </div>
        @if($channel->videos->count())
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border"><h3 class="box-title">Videos</h3></div>
                    <div class="box-body table-responsive no-padding">

                        @include('admin.videos.partials.list', ['videos' => $channel->videos])

                    </div>
                </div>
            </div>
        @endif
    </div>

@stop