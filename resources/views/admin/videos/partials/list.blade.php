<table class="table table-bordered table-striped table-hover" role="grid" aria-describedby="example2_info">
    <thead>
        <tr role="row">
            <th class="sorting" tabindex="0" aria-controls="admintable">id</th>
            <th tabindex="0">Image</th>
            <th class="sorting_asc" tabindex="0" aria-controls="admintable" aria-sort="ascending">Title</th>
            <th class="sorting" tabindex="0" aria-controls="admintable">Description</th>
            <th class="sorting" tabindex="0" aria-controls="admintable">Channel</th>
            <th class="sorting" tabindex="0" aria-controls="admintable">Views</th>
            <th class="sorting" tabindex="0" aria-controls="admintable">Data</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($videos as $video)
            <tr role="row">
                <td>{{ $video->id }}</td>
                <td><img src="{{ $video->thumbnail_url }}" alt="" width="100"></td>
                <td><a href="{{ url('/admin/videos/'.$video->uid.'/edit') }}">{{ $video->title }}</a></td>
                <td>{{ $video->description }}</td>
                <td><a href="{{ url('/admin/channels/'.$video->channel->slug.'/edit') }}">{{ $video->channel->name }}</a></td>
                <td>{{ $video->views->count() }}</td>
                <td>{{ $video->created_at }}</td>
            </tr>
        @endforeach
    </tbody>               
</table>