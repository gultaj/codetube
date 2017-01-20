@extends('adminlte::page')

@section('title', 'Channels')

@section('content_header')
    <h1>Channels <span> <a href="#" class="btn btn-primary btn-xs">Add new</a></span></h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Channels</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-body table-responsive no-padding">
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
                            @foreach ($channels as $index => $channel)
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

                </div>
                        <!-- /.box-body -->
            </div>
        </div>
        <div class="col-xs-5"></div>
        <div class="col-xs-7">{{ $channels->links() }}</div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#admintable').DataTable();
        } );
    </script>
@stop