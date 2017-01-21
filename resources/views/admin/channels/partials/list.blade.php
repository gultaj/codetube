<table class="table table-bordered table-striped table-hover" role="grid" aria-describedby="example2_info">
    <thead>
        <tr role="row">
            <th class="sorting" tabindex="0" aria-controls="admintable">id</th>
            <th tabindex="0">Image</th>
            <th class="sorting_asc" tabindex="0" aria-controls="admintable" aria-sort="ascending">Name</th>
            <th class="sorting" tabindex="0" aria-controls="admintable">Description</th>
            <th class="sorting" tabindex="0" aria-controls="admintable">Videos</th>
            <th class="sorting" tabindex="0" aria-controls="admintable">Subscribers</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($channels as $channel)
            <tr role="row">
                <td>{{ $channel->id }}</td>
                <td><img src="{{ $channel->thumbnail_url }}" alt=""></td>
                <td><a href="{{ url('/admin/channels/'.$channel->slug.'/edit') }}">{{ $channel->name }}</a></td>
                <td>{{ $channel->description }}</td>
                <td>{{ $channel->videos->count() }}</td>
                <td>{{ $channel->subscriptions->count() }}</td>
            </tr>
        @endforeach
    </tbody>               
</table>