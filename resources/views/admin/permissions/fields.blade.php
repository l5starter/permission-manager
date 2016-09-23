<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('permissions', 'Roles that have this permission:') !!}
    <div class="row">
        @foreach ($roles as $role)
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                               @if( old('roles') && in_array($role->id, old('roles')) || (isset($permission->roles) && in_array($role->id, $permission->roles->pluck('id', 'id')->toArray()))) checked="checked" @endif>
                        {{ $role->name }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="form-group col-sm-12">
    <a href="{!! route('admin.permissions.index') !!}" class="btn btn-default">{{ trans('l5starter::button.back') }}</a>
    {!! Form::submit(trans('l5starter::button.save'), ['class' => 'btn btn-primary']) !!}
</div>
