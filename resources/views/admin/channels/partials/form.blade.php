<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ?: $channel->name }}" required autofocus>
        @if ($errors->has('name'))
            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
    <label for="slug" class="col-md-2 control-label">Slug</label>
    <div class="col-md-10">
        <div class="input-group">
            <div class="input-group-addon">{{ config('app.url') }}/channel/</div>
            <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') ?: $channel->slug }}" required autofocus>
        </div>
        @if ($errors->has('slug'))
            <span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
    <label for="image" class="col-md-2 control-label">Channel image</label>
    <div class="col-md-10"><input id="image" type="file" name="image"></div>
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" id="description">{{ old('description') ?: $channel->description }}</textarea>
        @if ($errors->has('description'))
            <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
        @endif
    </div>
</div>
<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</div>
{{ csrf_field() }}