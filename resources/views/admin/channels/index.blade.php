@extends('adminlte::page')

@section('title', 'Channels')

@section('content_header')
    <h1>Channels <span> <a href="{{ url('/admin/channels/create') }}" class="btn btn-primary btn-xs">Add new</a></span></h1>
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

                    @include('admin.channels.partials.list', ['channels' => $channels])

                </div>
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