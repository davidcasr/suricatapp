<!-- Person Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('person_id', __('functionalities.assistants_var.person_id')) !!}
    {!! Form::text('person_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Group Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('group_id', __('functionalities.assistants_var.group_id')) !!}
    {!! Form::text('group_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Meeting Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('meeting_id', __('functionalities.assistants_var.meeting_id')) !!}
    {!! Form::text('meeting_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Confirmation Field -->
<div class="form-group col-sm-12">
    {!! Form::label('confirmation', __('functionalities.assistants_var.confirmation')) !!}
    {!! Form::text('confirmation', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('assistants.index') }}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>
