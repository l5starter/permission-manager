<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('permissions', 'Permissions:') !!}
    <div class="row">
        @foreach ($permissions as $permission)
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                               @if( old('permissions') && in_array($permission->id, old('permissions')) || (isset($role->permissions) && in_array($permission->id, $role->permissions->pluck('id', 'id')->toArray()))) checked="checked" @endif>
                        {{ $permission->name }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <a href="{!! route('admin.roles.index') !!}" class="btn btn-default">{{ trans('l5starter::button.back') }}</a>
    {!! Form::submit(trans('l5starter::button.save'), ['class' => 'btn btn-primary']) !!}
</div>
