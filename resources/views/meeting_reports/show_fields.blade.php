<!-- User Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('user_id', __('functionalities.meeting_reports_var.user_id')) !!}</b>
    <p>{{ $meetingReport->user_id }}</p>
</div>

<!-- Person Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('person_id', __('functionalities.meeting_reports_var.person_id')) !!}</b>
    <p>{{ $meetingReport->person_id }}</p>
</div>

<!-- Meeting Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('meeting_id', __('functionalities.meeting_reports_var.meeting_id')) !!}</b>
    <p>{{ $meetingReport->meeting_id }}</p>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('description', __('functionalities.meeting_reports_var.description')) !!}</b>
    <p>{{ $meetingReport->description }}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b>
    <p>{{ $meetingReport->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b>
    <p>{{ $meetingReport->updated_at }}</p>
</div>

