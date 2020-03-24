<!-- first_name Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('first_name', __('functionalities.users_var.first_name')) !!}</b>
    <p>{!! $user->first_name !!}</p>
</div>

<!-- last_name Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('last_name', __('functionalities.users_var.last_name')) !!}</b>
    <p>{!! $user->last_name !!}</p>
</div>

<!-- username Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('username', __('functionalities.users_var.username')) !!}</b>
    <p>{!! $user->username !!}</p>
</div>

<!-- email Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('email', __('functionalities.users_var.email')) !!}</b>
    <p>{!! $user->email !!}</p>
</div>

<!-- phone Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('phone', __('functionalities.users_var.phone')) !!}</b>
    <p>{!! $user->phone !!}</p>
</div>

<!-- role Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('role', __('functionalities.users_var.roles')) !!}</b>
    <p>
    @foreach($user->roles->pluck('name') as $role)
        <span class="badge badge-info">{{ $role }}</span>
    @endforeach
    </p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b>
    <p>{!! $user->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b>
    <p>{!! $user->updated_at !!}</p>
</div>

