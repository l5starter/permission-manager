@extends('l5starter::admin.layouts.master')

@section('content-header')
    <h1 class="pull-left">
        Role
    </h1>
    <div class="pull-right">
        <a class="btn btn-primary pull-right" href="{!! route('admin.roles.create') !!}">{{ trans('l5starter::button.add') }}</a>
    </div>
    <div class="clearfix"></div>
@stop

@section('content')
    @include('flash::message')

    <div class="box box-default">
        <div class="box-body no-padding table-responsive">
            @include('roles::table')
            {{ $roles->links() }}
        </div>
    </div>
@endsection

