<!-- Group Cod Field -->
<div class="form-group col-sm-12">
    {!! Form::label('group_cod', __('functionalities.gen_groups_var.group_cod')) !!}
    {!! Form::text('group_cod', null, ['class' => 'form-control']) !!}
</div>

<!-- Group Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('group_description', __('functionalities.gen_groups_var.group_description')) !!}
    {!! Form::text('group_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Enabled Field -->
<div class="form-group col-sm-12">
    {!! Form::label('enabled', __('functionalities.gen_groups_var.enabled')) !!}
    {!! Form::selectRange('enabled', 0, 1, 1, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('genGroups.index') !!}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>
