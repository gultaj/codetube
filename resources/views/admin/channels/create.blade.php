@extends('adminlte::page')

@section('title', 'Edit channel')

@section('content_header')
    <h1>Create channel</h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/channels') }}"><i class="fa fa-list"></i> Channels</a></li>
        <li class="active">New channel</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form class="form-horizontal" role="form" method="POST" action="/admin/channels" enctype="multipart/form-data">
                        @include('admin.channels.partials.form', ['errors' => $errors, 'channel' => null])
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop