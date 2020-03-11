<!-- name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('functionalities.roles_var.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit( __('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('abilities.index') !!}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>


