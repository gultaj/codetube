<div class="row">
    <div class="col-sm-3">
        <a href="{{ route('video', ['video' => $video->uid]) }}">
            <img src="{{ $video->thumbnail_url }}" alt="" class="img-responsive">
        </a>
    </div>
    <div class="col-sm-9">
        <a href="{{ route('video', ['video' => $video->uid]) }}">{{ $video->title }}</a>
        @if ($video->description)
            <p>{{ $video->description }}</p>
        @else
            <p class="muted">No description</p>
        @endif
        
        <ul class="list-inline">
            <li><a href="{{ route('channel', ['channel' => $video->channel->slug]) }}">{{ $video->channel->name }}</a></li>
            <li>{{ $video->created_at->diffForHumans() }}</li>
            <li>{{ $video->view_count }} {{ str_plural('view', $video->view_count) }}</li>
        </ul>
    </div>
</div>