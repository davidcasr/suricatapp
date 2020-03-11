<!-- Identification Field -->
<div class="form-group col-sm-12">
    {!! Form::label('identification', __('functionalities.plans_var.identification')) !!}
    {!! Form::text('identification', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('functionalities.plans_var.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-12">
    {!! Form::label('price', __('functionalities.plans_var.price')) !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Q Users Field -->
<div class="form-group col-sm-12">
    {!! Form::label('q_users', __('functionalities.plans_var.q_users')) !!}
    {!! Form::number('q_users', null, ['class' => 'form-control']) !!}
</div>

<!-- Q Administrators Field -->
<div class="form-group col-sm-12">
    {!! Form::label('q_administrators', __('functionalities.plans_var.q_administrators')) !!}
    {!! Form::number('q_administrators', null, ['class' => 'form-control']) !!}
</div>

<!-- Q Communities Field -->
<div class="form-group col-sm-12">
    {!! Form::label('q_communities', __('functionalities.plans_var.q_communities')) !!}
    {!! Form::number('q_communities', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('plans.index') !!}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>
