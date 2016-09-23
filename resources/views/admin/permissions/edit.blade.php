@extends('l5starter::admin.layouts.master')

@section('content-header')
    <h1 class="pull-left">
        Permission
    </h1>
    <div class="clearfix"></div>
@stop

@section('content')
    @include('l5starter::common.errors')

    <div class="box box-default">
        <div class="box-body">
            <div class="row">
                {!! Form::model($permission, ['route' => ['admin.permissions.update', $permission->id], 'method' => 'patch']) !!}
                    @include('permissions::fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection