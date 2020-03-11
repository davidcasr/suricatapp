<!-- name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('functionalities.roles_var.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<!-- title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', __('functionalities.roles_var.title')) !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>  

<!-- abilities Field -->
<div class="form-group col-sm-12">
    {!! Form::label('abilities', trans_choice('functionalities.abilities', 1)) !!}
    @if(isset($user))
        <br>
        {!! Form::select('abilities', $abilities, old('abilities') ? old('role') : $user->abilities()->pluck('name', 'name'), ['class' => 'form-control', 'required' => 'required', 'multiple' => 'multiple']) !!}
    @else
        {!! Form::select('abilities', $abilities, null, ['class' => 'form-control', 'required' => 'required', 'multiple' => 'multiple']) !!}
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
           $('#abilities').select2({
               width: '100%',
           });
       });
    </script>
@endsection


