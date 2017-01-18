@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard <small>Control panel</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="info-box bg-yellow-gradient">
                <span class="info-box-icon"><i class="ion-ios-people-outline"></i></span>
                <div class="info-box-content bg-yellow">
                    <span class="info-box-text">Channels</span>
                    <span class="info-box-number">{{ $channel_count }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="info-box bg-green-gradient">
                <span class="info-box-icon"><i class="ion-checkmark"></i></span>
                <div class="info-box-content bg-green">
                    <span class="info-box-text">Videos</span>
                    <span class="info-box-number">{{ $video_count }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="info-box bg-aqua-gradient">
                <span class="info-box-icon"><i class="ion-arrow-graph-up-right"></i></span>
                <div class="info-box-content bg-aqua">
                    <span class="info-box-text">Comments</span>
                    <span class="info-box-number">{{ $comment_count }}</span>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop