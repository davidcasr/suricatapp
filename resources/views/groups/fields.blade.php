<!-- Parent Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('parent_id', __('functionalities.groups_var.parent_id')) !!}
    {!! Form::text('parent_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Identification Field -->
<div class="form-group col-sm-12">
    {!! Form::label('identification', __('functionalities.groups_var.identification')) !!}
    {!! Form::text('identification', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('functionalities.groups_var.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('functionalities.groups_var.description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 250]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('groups.index') }}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>
