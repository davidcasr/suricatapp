<!-- Meeting Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('meeting_id', __('functionalities.assistants_var.meeting_id')) !!}</b>
    <p>{{ $assistant->meetings->full_meeting }}</p>
</div>

<!-- Person Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('person_id', __('functionalities.assistants_var.person_id')) !!}</b>
    <p>{{ $assistant->people->email }}</p>
</div>

<!-- Confirmation Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('confirmation', __('functionalities.assistants_var.confirmation')) !!}</b>
    <p>
        @if ($assistant->confirmation == 0)
            <span style="color: red;">
                <i class="fas fa-times-circle"></i>
            </span>
        @elseif($assistant->confirmation == 1)
            <span style="color: green;">
                <i class="fas fa-check-circle"></i>
            </span>
        @elseif($assistant->confirmation == 2)
            <span style="color: blue;">
                <i class="fas fa-envelope"></i>
            </span>
        @endif
    </p>
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

