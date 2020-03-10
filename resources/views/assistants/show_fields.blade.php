<!-- Person Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('person_id', __('functionalities.assistants_var.person_id')) !!}</b>
    <p>{{ $assistant->person_id }}</p>
</div>

<!-- Group Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('group_id', __('functionalities.assistants_var.group_id')) !!}</b>
    <p>{{ $assistant->group_id }}</p>
</div>

<!-- Meeting Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('meeting_id', __('functionalities.assistants_var.meeting_id')) !!}</b>
    <p>{{ $assistant->meeting_id }}</p>
</div>

<!-- Confirmation Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('confirmation', __('functionalities.assistants_var.confirmation')) !!}</b>
    <p>{{ $assistant->confirmation }}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b>
    <p>{{ $assistant->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b>
    <p>{{ $assistant->updated_at }}</p>
</div>

