<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('functionalities.features_var.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('functionalities.features_var.description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control ckeditor','maxlength' => 250]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('features.index') }}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>
