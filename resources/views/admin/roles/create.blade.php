@extends('l5starter::admin.layouts.master')

@section('content-header')
    <h1 class="pull-left">
        Role
    </h1>
    <div class="clearfix"></div>
@stop

@section('content')
    @include('l5starter::common.errors')

    <div class="box box-default">
        <div class="box-body">
            <div class="row">
                {!! Form::open(['route' => 'admin.roles.store']) !!}
                    @include('roles::fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
