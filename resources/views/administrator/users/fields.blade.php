<!-- first_name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('first_name', __('functionalities.users_var.first_name')) !!}
    {!! Form::text('first_name', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<!-- last_name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('last_name', __('functionalities.users_var.last_name')) !!}
    {!! Form::text('last_name', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<!-- username Field -->
<div class="form-group col-sm-12">
    {!! Form::label('username', __('functionalities.users_var.username')) !!}
    {!! Form::text('username', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', __('functionalities.users_var.email')) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- password Field -->
<div class="form-group col-sm-12">
    {!! Form::label('password', __('functionalities.users_var.password')) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
    @if( isset($user) )
        <small><b>Dejar en blanco para conservar la misma contraseña</b></small>
    @endif
</div>

<!-- phone Field -->
<div class="form-group col-sm-12">
    {!! Form::label('phone', __('functionalities.users_var.phone')) !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'maxlength' => 100]) !!}
</div>

<!-- role Field -->
<div class="form-group col-sm-12">
    {!! Form::label('roles', trans_choice('functionalities.roles', 1)) !!}
    @if(isset($user))
        <br>
        {!! Form::select('roles', $roles, old('roles') ? old('role') : $user->roles()->pluck('name', 'name'), ['class' => 'form-control', 'required' => 'required', 'multiple' => 'multiple']) !!}
    @else
        {!! Form::select('roles', $roles, null, ['class' => 'form-control', 'required' => 'required', 'multiple' => 'multiple']) !!}
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit( __('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>

@section('scripts')
   <script>
       $(document).ready(function () {
           $('#roles').select2({
               width: '100%',
           });
       });
    </script>
@endsection


