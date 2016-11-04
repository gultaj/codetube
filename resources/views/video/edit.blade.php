@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit video "{{ $video->title }}"</div>

                    <div class="panel-body">
                        <form action="{{ route('video.update', ['video' => $video->uid]) }}" method="post" class="form-horizontal">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-3 control-label">Title</label>
                                <div class="col-md-9">
                                    <input id="title" type="text" class="form-control" name="title" 
                                        value="{{ old('title') ?: $video->title }}" required autofocus>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-3 control-label">Description</label>
                                <div class="col-md-9">
                                    <textarea name="description" id="description" class="form-control">{{ old('description') ?: $video->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('visibility') ? ' has-error' : '' }}">
                                <label for="visibility" class="col-md-3 control-label">Visibility</label>
                                <div class="col-md-9">
                                    <select name="visibility" id="visibility" class="form-control">
                                        @foreach (['private', 'unlisted', 'public'] as $visibility)
                                            <option value="{{ $visibility }}"{{ $video->visibility === $visibility ? ' selected="selected"' : '' }}>{{ ucfirst($visibility) }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('visibility'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('visibility') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="allow_votes" id="allow_votes"{{ $video->allow_votes ? ' checked="checked"' : '' }}> Allow votes
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="allow_comments" id="allow_comments"{{ $video->allow_comments ? ' checked="checked"' : '' }}> Allow comments
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>                                
                            </div>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
