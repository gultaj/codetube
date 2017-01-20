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
        <div class="col-md-offset-2 col-xs-8 "> 
            <div class="box">
                <div class="box-body">
                    <form class="form-horizontal" role="form" method="POST" action="/admin/channels/{{ $channel->slug }}" enctype="multipart/form-data">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">Name</label>

                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control" name="name" 
                                    value="{{ old('name') ?: $channel->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                            <label for="slug" class="col-md-3 control-label">Slug</label>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon">{{ config('app.url') }}/channel/</div>
                                    <input id="slug" type="text" class="form-control" name="slug" 
                                        value="{{ old('slug') ?: $channel->slug }}" required autofocus>
                                </div>

                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-3 control-label">Channel image</label>

                            <div class="col-md-9">
                                <input id="image" type="file" name="image">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-3 control-label">Description</label>

                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="description">{{ old('description') ?: $channel->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop